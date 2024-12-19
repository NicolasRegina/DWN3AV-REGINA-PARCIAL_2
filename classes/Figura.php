<?PHP

class Figura {
    private int $id;
    private string $personaje;
    private int $precio;
    private string $fechaLanzamiento;
    private string $descripcion;
    private bool $novedad;
    private Franquicia $franquicia;
    private Marca $marca;
    private string $bajada;
    private Imagen $portada;
    private Imagen $imagenes;
    private array $categorias;


    private static $createValues = ['id', 'personaje', 'precio', 'fechaLanzamiento', 'descripcion', 'novedad', 'bajada'];

     /**
     * Devuelve una instancia del objeto Figura, con todas sus propiedades configuradas
     *@return Figura
     */
    public static function createFigura($figuraData){
        $figura = new Self();

        // echo "<pre>";
        // print_r($figuraData);
        // echo "</pre>";

        foreach (self::$createValues as $value) {
            $figura->{$value} = $figuraData[$value];
        }

        $figura->franquicia = (new Franquicia())->get_x_id($figuraData['franquicia_id']);
        $figura->marca = (new Marca())->get_x_id($figuraData['marca_id']);
        $figura->portada = (new Imagen())->get_first_result($figuraData['id']);
        $figura->imagenes = (new Imagen())->get_x_id_producto($figuraData['id']);
        $figura->categorias = (new Categoria())->categorias_x_producto($figuraData['id']);
        
        // echo "<pre>";
        // print_r($figura);
        // echo "</pre>";

        return $figura;
    }


    /**
     * Devuelve el catálogo completo de productos
     * @return array Un array de objetos Figura
     */
    public static function catalogoCompleto(): array {
        
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        // echo "<pre>";
        // print_r($PDOStatement->fetch());
        // echo "</pre>";


        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createFigura($result);
        }

        return $catalogo;
    }

    /**
     * Devuelve los datos de un producto en particular
     * @param string $idProducto
     * 
     * @return Figura Un objeto Figura
     
     */
    public static function productoPorId(int $idProducto): ?Figura {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos p WHERE p.id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->bindParam(':id', $idProducto, PDO::PARAM_INT);
        $PDOStatement->execute();

        $result = self::createFigura($PDOStatement->fetch());

        return $result ? $result : null;
    }

    /**
    *  Devuelve el catalogo de productos por marca
    * @param string $idMarca Un string con el id de la marca a buscar
    * 
    * @return array Un Array lleno de instancias de objeto Figura.
    */
    public static function catalogoPorMarca(string $idMarca): array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos p WHERE p.marca_id = :idMarca";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->bindParam(':idMarca', $idMarca, PDO::PARAM_STR);
        $PDOStatement->execute();

        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createFigura($result);
        }

        return $catalogo;
    }

    public function nombreCatalogoPorMarca(string $id_marca): string {
        $conexion = Conexion::getConexion();
        $query = "SELECT nombre FROM marcas WHERE id = :id_marca";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
        return $result['nombre'] ?? ''; // Devuelve el nombre si existe, o una cadena vacía si no.
    }

    /**
    *  Devuelve el catalogo de productos de una franquicia en particular
    * @param string $idFranquicia Un string con el id de la franquicia a buscar
    * 
    * @return array Un Array lleno de instancias de objeto Figura.
    */
    public static function catalogoPorFranquicia(string $idFranquicia): array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos p WHERE p.franquicia_id = :idFranquicia";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->bindParam(':idFranquicia', $idFranquicia, PDO::PARAM_STR);
        $PDOStatement->execute();

        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createFigura($result);
        }

        return $catalogo;
    }

    public function nombreCatalogoPorFranquicia(string $id_franquicia): string {
        $conexion = Conexion::getConexion();
        $query = "SELECT nombre FROM franquicias WHERE id = :id_franquicia";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id_franquicia', $id_franquicia, PDO::PARAM_STR);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
        return $result['nombre'] ?? '';
    }
    

    /**
    *  Devuelve el catalogo de productos de una categoría en particular
    * @param string $idCategoria Un string con el id de la categoría a buscar
    * 
    * @return array Un Array lleno de instancias de objeto Figura.
    */
    public static function catalogoPorCategoria(string $idCategoria): array {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos p
        INNER JOIN productos_categorias pc ON p.id = pc.producto_id
        WHERE pc.categoria_id = :idCategoria";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->bindParam(':idCategoria', $idCategoria, PDO::PARAM_STR);
        $PDOStatement->execute();

        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createFigura($result);
        }

        return $catalogo;
    }

    public function nombreCatalogoPorCategoria(string $id_categoria): string {
        $conexion = Conexion::getConexion();
        $query = "SELECT nombre FROM categorias WHERE id = :id_categoria";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id_categoria', $id_categoria, PDO::PARAM_STR);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
        return $result['nombre'] ?? '';
    }

    // Devuelve el catalogo de productos novedadosos recibiendo un booleano
    public static function catalogoNovedades(bool $new): array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos p
        WHERE p.novedad = $new";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createFigura($result);
        }

        return $catalogo;
    }
    
    public function precio_formateado(): string
    {
        return number_format($this->precio, 2, ",", ".");
    }

    //SECTION CRUD

    /**
     * Inserta un nuevo producto a la base de datos
     * @param string $personaje
     * @param float $precio   
     * @param string $fechaLanzamiento
     * @param int $descripcion
     * @param bool $novedad
     * @param int $franquicia_id
     * @param int $marca_id
     * @param string $bajada 
     */
    public static function insert($personaje, $precio, $fechaLanzamiento, $descripcion, $novedad, $franquicia_id, $marca_id, $bajada): int
    {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos VALUES (NULL, :personaje, :precio, :fechaLanzamiento, :descripcion, :novedad, :franquicia_id, :marca_id, :bajada)";

        $PDOStatement = $conexion->prepare($query);
        if($PDOStatement->execute(
            [
                'personaje' => $personaje,
                'precio' => $precio,
                'fechaLanzamiento' => $fechaLanzamiento,
                'descripcion' => $descripcion,
                'novedad' => $novedad,
                'franquicia_id' => $franquicia_id,
                'marca_id' => $marca_id,
                'bajada' => $bajada
            ]
        )){
            return $conexion->lastInsertId();
        } else{
            throw new Exception('No se pudo insertar el producto');
        };

    }

    /**
     * Inserta una categoría para este producto
     * @param int $categoria_id
     * @param int $producto_id
     */
    public static function insert_categoria_producto(int $categoria_id, int $producto_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos_categorias (producto_id, categoria_id) VALUES (:producto_id, :categoria_id)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $producto_id,
                'categoria_id' => $categoria_id
            ]
        );
    }

    public static function clear_categoria_producto(int $producto_id)
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias WHERE producto_id = :producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(['producto_id' => $producto_id]);
    }

    public function edit($personaje, $franquicia_id, $marca_id, $descripcion, $fechaLanzamiento, $novedad, $precio, $bajada)
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE productos SET
        personaje = :personaje,
        precio = :precio,
        fechaLanzamiento = :fechaLanzamiento,
        descripcion = :descripcion,
        novedad = :novedad,
        franquicia_id = :franquicia_id,
        marca_id = :marca_id,
        bajada = :bajada
        WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'personaje' => $personaje,
                'precio' => $precio,
                'fechaLanzamiento' => $fechaLanzamiento,
                'descripcion' => $descripcion,
                'novedad' => $novedad,
                'franquicia_id' => $franquicia_id,
                'marca_id' => $marca_id,
                'bajada' => $bajada,
            ]
        );
    }

    /**
     * Vaciar lista de categorias
     */
    public function clear_categorias()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias WHERE producto_id = :producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $this->id
            ]
        );
    }

    /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    public function delete_imagenes()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM imagenes WHERE producto_id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getPersonaje() {
        return $this->personaje;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPortada() {
        return $this->portada;
    }

    public function getFechaLanzamiento() {
        return $this->fechaLanzamiento;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getNovedad() {
        return $this->novedad;
    }

    public function getFranquicia() {
        return $this->franquicia;
    }

    public function getMarca() {
        return $this->marca;
    }

    //TODO: Revisar este get
    public function getCategoria(){
        return $this->categorias;
    }

    public function getBajada() {
        return $this->bajada;
    }

    /**
     * Esta método devuelve las primeras x palabras de la bajada 
     * 
     * @param int $cantidad Esta es la cantidad de palabras a extraer (Opcional)
     */
    public function bajada_reducida(int $cantidad = 10): string
    {
        $texto = $this->bajada;

        $array = explode(" ", $texto);
        if (count($array) <= $cantidad) {
            $resultado = $texto;
        } else {
            array_splice($array, $cantidad);
            $resultado = implode(" ", $array) . "...";
        }

        return $resultado;
    }

    /**
     * @return array
     */
    public function getImagenes() {
        $imageUrls = explode(', ', $this->imagenes->imagenes);
        return $imageUrls;
    }
    
    //TODO: hacer getNombresImagenes
    // public function getNombresImagenes() {
    //     $imageUrls = explode(', ', $this->imagenes->imagenes);
    //     return $imageUrls;
    // }

}
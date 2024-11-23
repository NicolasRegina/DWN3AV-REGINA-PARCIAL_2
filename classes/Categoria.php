<?PHP

class Categoria{
    private int $id;
    private string $nombre;
    private string $descripcion;
    private string $imagen;
    private string $fecha_creacion;
    private string $fecha_actualizacion;

    /**
     * Devuelve el listado completo de categorías en sistema
     */
    public static function lista_completa(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categorias";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

    public static function lista_categorias(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT id, nombre FROM categorias";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

    /**
     * Devuelve los datos de una categoría en particular
     * @param int $id El ID único de la categoría 
    */
    public static function get_x_id(int $id): ?Categoria
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categorias WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;
    }

    /**
     * Devuelve el id y nombre de una categoría en particular
     * @param int $id El ID único de la categoría 
    */
    public static function cat_x_id(int $id): ?Categoria
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT id, nombre FROM categorias WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;
    }

    /**
     * Devuelve las categorías asociadas a un producto en particular
     * @param int $producto_id El ID único del producto
     * */
    public static function categorias_x_producto(int $producto_id): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT GROUP_CONCAT(c.nombre SEPARATOR ', ') as categorias FROM categorias c
                  INNER JOIN productos_categorias pc ON c.id = pc.categoria_id
                  WHERE pc.producto_id = $producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }
    
    /**
     * Devuelve los IDs de las categorías asociadas a un producto en particular
     * @param int $producto_id El ID único del producto
     * */
    public static function categorias_x_producto_value(int $producto_id): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT c.id FROM categorias c
                INNER JOIN productos_categorias pc ON c.id = pc.categoria_id
                WHERE pc.producto_id = :producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(['producto_id' => $producto_id]);

        $lista = $PDOStatement->fetchAll(PDO::FETCH_COLUMN, 0);

        return $lista;
    }

    /**
     * Verifica si una categoría está asociada a algún producto
     * @param int $categoria_id El ID único de la categoría
     */
    public static function tieneProductosAsociados(int $categoria_id): bool
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT COUNT(*) FROM productos_categorias WHERE categoria_id = :categoria_id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $PDOStatement->execute();

        return $PDOStatement->fetchColumn() > 0;
    }

    public static function borrarCategoria(int $id): bool
    {
        if (self::tieneProductosAsociados($id)) {
            throw new Exception("No se puede eliminar la categoría porque está asociada a uno o más productos.");
        }

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM categorias WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public static function insertCategoria(string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);

        return $PDOStatement->execute();
    }

    public static function editCategoria(int $id, string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE categorias SET nombre = :nombre WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function getFechaActualizacion() {
        return $this->fecha_actualizacion;
    }

}
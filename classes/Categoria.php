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
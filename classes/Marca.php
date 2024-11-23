<?PHP

class Marca{
    private $id;
    private $nombre;

    /**
     * Devuelve el listado completo de franquicias en sistema
    */
    public static function lista_completa(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM marcas";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

    /**
     * Devuelve los datos de una franquicia en particular
     * @param int $id El ID único de la franquicia 
    */
    public static function get_x_id(int $id): ?Marca
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM marcas WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;
    }

    public static function editMarca(int $id, string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE marcas SET nombre = :nombre WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public static function tieneProductosAsociados(int $id): bool
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT COUNT(*) FROM productos WHERE marca_id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();

        return $PDOStatement->fetchColumn() > 0;
    }

    public static function borrarMarca(int $id): bool
    {
        if (self::tieneProductosAsociados($id)) {
            throw new Exception("No se puede eliminar la marca porque está asociada a uno o más productos.");
        }

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM marcas WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public static function insertMarca(string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO marcas (nombre) VALUES (:nombre)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);

        return $PDOStatement->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

}

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

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

}

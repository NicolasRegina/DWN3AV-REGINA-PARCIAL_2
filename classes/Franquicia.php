<?PHP

class Franquicia {
    private $id;
    private $nombre;
    
    /**
     * Devuelve el listado completo de franquicias en sistema
    */
    public static function lista_completa(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM franquicias";

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
    public static function get_x_id(int $id): ?Franquicia
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM franquicias WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;
    }

    function convertirArregloEnFranquicias($arreglo) {
        $franquicias = [];
        foreach ($arreglo as $item) {
            $franquicia = new Franquicia();
            $franquicia->setId($item['id']);
            $franquicia->setNombre($item['nombre']);
            $franquicias[] = $franquicia;
        }
        return $franquicias;
    }

    public static function tieneProductosAsociados(int $id): bool
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT COUNT(*) FROM productos WHERE franquicia_id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();

        return $PDOStatement->fetchColumn() > 0;
    }

    public static function borrarFranquicia(int $id): bool
    {
        if (self::tieneProductosAsociados($id)) {
            throw new Exception("No se puede eliminar la franquicia porque está asociada a uno o más productos.");
        }

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM franquicias WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public static function insertFranquicia(string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO franquicias (nombre) VALUES (:nombre)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);

        return $PDOStatement->execute();
    }

    public static function editFranquicia(int $id, string $name): bool
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE franquicias SET nombre = :nombre WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':nombre', $name, PDO::PARAM_STR);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);

        return $PDOStatement->execute();
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
}
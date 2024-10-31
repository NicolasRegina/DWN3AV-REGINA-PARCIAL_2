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

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }
}
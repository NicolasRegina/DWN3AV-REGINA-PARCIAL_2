<?PHP

class Imagen {
    private $id;
    private $producto_id;
    private $url;


    /**
     * Devuelve una imagen en particular de cualquier producto
     *  @param int $id El ID único de la imagen
     */
    public static function get_x_id(int $id) {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM imagenes WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;

    }

    /**
     * Devuelve las imagenes de un producto en particular
     * @param int $id el ID único del producto
     */
    public static function get_x_id_producto(int $id) {
        $conexion = Conexion::getConexion();
        $query = "SELECT GROUP_CONCAT(url SEPARATOR ', ') as imagenes 
        FROM imagenes WHERE producto_id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;

    }

    /**
     * Devuelve la primera imagen de un producto, que seria su portada
     * @param int $id el ID único del producto     
     */
    public static function get_first_result(int $id) {

        $conexion = Conexion::getConexion();

        $query = "SELECT * FROM imagenes WHERE producto_id = :id ORDER BY id ASC LIMIT 1";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ? $result : null;
    }

    /**
     * Inserta las imagenes de un producto en particular
     * @param string $directorio el path donde se encuentra el archivo
     * @param string $datosArchivo el nombre del archivo
     * @param string $producto_id el ID del producto a cual corresponde la img
     */
    public static function subirImagen($directorio, $datosArchivo, $producto_id): string
    {
        // Le damos un nuevo nombre
        $og_name = explode(".", $datosArchivo['name']);
        $extension = end($og_name);
        $filename = time() . uniqid() . ".$extension";

        // Movemos el archivo subido al directorio especificado
        $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$filename");

        if (!$fileUpload) {
            throw new Exception("No se pudo subir la imagen");
        } else {
            // Insertar en la base de datos
            $conexion = Conexion::getConexion();
            $query = "INSERT INTO imagenes (producto_id, url) VALUES (:producto_id, :url)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $filename = "img/productos/generales/" . $filename;
            $PDOStatement->bindParam(':url', $filename, PDO::PARAM_STR);

            if (!$PDOStatement->execute()) {
                throw new Exception("No se pudo insertar la imagen en la base de datos");
            }

            return $filename;
        }
    }

    public static function updateImagen($oldUrl, $directorio, $datosArchivo): string
    {
        // Le damos un nuevo nombre
        $og_name = explode(".", $datosArchivo['name']);
        $extension = end($og_name);
        $filename = time() . uniqid() . ".$extension";

        // Movemos el archivo subido al directorio especificado
        $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$filename");

        if (!$fileUpload) {
            throw new Exception("No se pudo subir la imagen");
        } else {        
            $conexion = Conexion::getConexion();
            $query = "UPDATE imagenes SET url = :newUrl WHERE url = :oldUrl";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->bindParam(':oldUrl', $oldUrl, PDO::PARAM_STR);
            $filename = "img/productos/generales/" . $filename;
            $PDOStatement->bindParam(':newUrl', $filename, PDO::PARAM_STR);

            if (!$PDOStatement->execute()) {
                throw new Exception("No se pudo actualizar la imagen en la base de datos");
            }

            return $filename;
        }
    }

    public static function borrarImagen($archivo): bool
    {
        // error_log($archivo);
        if (file_exists(($archivo))) {
  
            $fileDelete =  unlink($archivo);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }

    public static function add_imagenes_extra(int $producto_id, string $url): void{
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO imagenes VALUES (NULL, :producto_id, :url)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $producto_id,
                'url' => $url
            ]
        );        
    }

    public function getId() {
        return $this->id;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getUrl() {
        return $this->url;
    }

}
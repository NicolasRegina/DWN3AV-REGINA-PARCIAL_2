<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de franquicia no proporcionado.");
    }
    Franquicia::borrarFranquicia($id);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo eliminar la franquicia");
}

header('Location: ../index.php?sec=admin_franquicia');
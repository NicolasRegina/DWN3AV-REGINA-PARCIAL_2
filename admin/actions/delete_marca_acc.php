<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de marca no proporcionado.");
    }
    Marca::borrarMarca($id);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo eliminar la marca");
}

header('Location: ../index.php?sec=admin_marca');
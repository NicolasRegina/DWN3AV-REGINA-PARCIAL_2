<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de categoría no proporcionado.");
    }
    Categoria::borrarCategoria($id);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo eliminar la categoría");
}

header('Location: ../index.php?sec=admin_categoria');
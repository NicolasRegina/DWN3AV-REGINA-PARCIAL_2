<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de categoría no proporcionado.");
    }
    Categoria::borrarCategoria($id);

} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo eliminar la categoría");
    header('Location: ../index.php?sec=admin_categoria');
}

Alerta::add_alerta("danger", "La categoria se eliminó correctamente");
header('Location: ../index.php?sec=admin_categoria');
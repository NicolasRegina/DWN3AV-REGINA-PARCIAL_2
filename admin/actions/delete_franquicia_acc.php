<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de franquicia no proporcionado.");
    }
    Franquicia::borrarFranquicia($id);

} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo eliminar la franquicia");
    header('Location: ../index.php?sec=admin_franquicia');
}

Alerta::add_alerta("danger", "La franquicia se eliminó correctamente");
header('Location: ../index.php?sec=admin_franquicia');
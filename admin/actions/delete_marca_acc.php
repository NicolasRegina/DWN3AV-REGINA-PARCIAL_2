<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {

    if (!$id) {
        throw new Exception("ID de marca no proporcionado.");
    }
    Marca::borrarMarca($id);

} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo eliminar la marca");
    header('Location: ../index.php?sec=admin_marca');
}

Alerta::add_alerta("danger", "La marca se eliminó correctamente");
header('Location: ../index.php?sec=admin_marca');
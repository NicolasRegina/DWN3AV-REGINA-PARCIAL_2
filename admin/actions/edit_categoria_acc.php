<?PHP
require_once "../../functions/autoload.php";

$id = $_POST['id'] ?? FALSE;
$name = $_POST['nombre'] ?? FALSE;

echo "<pre>";
print_r($id);
echo "</pre>";

try {

    if (!$id || !$name) {
        throw new Exception("ID o nombre de categoría no proporcionado.");
    }
    Categoria::editCategoria($id, $name);

} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo editar la categoría");
    header('Location: ../index.php?sec=admin_categoria');
}

Alerta::add_alerta("success", "La categoría se edito correctamente");
header('Location: ../index.php?sec=admin_categoria');
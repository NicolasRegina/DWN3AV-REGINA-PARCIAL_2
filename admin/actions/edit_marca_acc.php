<?PHP
require_once "../../functions/autoload.php";

$id = $_POST['id'] ?? FALSE;
$name = $_POST['nombre'] ?? FALSE;

echo "<pre>";
print_r($id);
echo "</pre>";

try {

    if (!$id || !$name) {
        throw new Exception("ID o nombre de marca no proporcionado.");
    }
    Marca::editMarca($id, $name);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo editar la marca");
}

header('Location: ../index.php?sec=admin_marca');
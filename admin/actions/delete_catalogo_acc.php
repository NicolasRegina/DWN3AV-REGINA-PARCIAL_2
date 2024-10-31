<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;


try {

    $figura = Figura::productoPorId($id);
    // var_dump($figura->getPortada()->getUrl());
   
    Imagen::borrarImagen(__DIR__ . "/../" . $figura->getPortada()->getUrl());
    $figura->delete_imagenes();
    $figura->clear_categorias();
    $figura->delete();
    



} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo eliminar el producto");
}

header('Location: ../index.php?sec=admin_catalogo');
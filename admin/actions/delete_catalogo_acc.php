<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;


try {

    $figura = Figura::productoPorId($id);
    // var_dump($figura->getPortada()->getUrl());
   
    Imagen::borrarImagen(__DIR__ . "/../" . $figura->getPortada()->getUrl());
    $figura->delete_imagenes();
    //TODO: Eliminar las imagenes locales (ver como esta hecho el edit_catalog_acc)
    $figura->clear_categorias();
    $figura->delete();
    



} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo eliminar el producto");
    header('Location: ../index.php?sec=admin_catalogo');
}

Alerta::add_alerta("danger", "El producto se eliminó correctamente");
header('Location: ../index.php?sec=admin_catalogo');
<?PHP
require_once "../../functions/autoload.php";
// require_once "Classes/Imagen.php";
// require_once "Classes/Figura.php";

$postData = $_POST;
$fileData = $_FILES['portada'] ?? FALSE;
$fileDataGal = $_FILES['galeria'] ?? FALSE;
$id = $_GET['id'] ?? FALSE;


echo "<pre>";
print_r($fileData);
echo "</pre>";

try {

    $figura = Figura::productoPorId($id);
    $imagenes = Imagen::get_x_id_producto($id);

    $url ="../img/logo.png";

    if (isset($postData['imagenes'])) {
        foreach ($postData['imagenes'] as $producto_id) {
            $imagenes->add_imagenes_extra($producto_id, $url);
        }
    }

    if (!empty($fileData['tmp_name'])) {
        $portada = Imagen::subirImagen(__DIR__ . "/../../img", $fileData);
        Imagen::borrarImagen(__DIR__ . "/../../img/" . $postData['portada_og']);
    } else {
        $portada = $postData['portada_og'];
    }

    $figura->edit(
        $postData['personaje'],
        $postData['precio'],
        $postData['fechaLanzamiento'],
        $postData['descripcion'],
        $postData['novedad'],
        $postData['franquicia_id'],
        $postData['marca_id'],
        $postData['bajada']
    );
} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo editar el producto");
}


header('Location: ../index.php?sec=admin_catalogo');

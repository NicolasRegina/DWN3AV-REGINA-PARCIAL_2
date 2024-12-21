<?PHP
require_once "../../functions/autoload.php";
// require_once "Classes/Imagen.php";
// require_once "Classes/Figura.php";

$postData = $_POST;
$fileData = $_FILES['portada'] ?? FALSE;
$fileDataGal = $_FILES['galeria'] ?? FALSE;
$id = $_GET['id'] ?? FALSE;

function reArrayFiles($file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

// Verificar si 'galería' es un array o un solo archivo
if (is_array($fileDataGal['name'])) {
    // Reorganizar los archivos de la galería
    $galeriaFiles = reArrayFiles($fileDataGal);
} else {
    // Convertir a un array de un solo archivo
    $galeriaFiles = array($fileDataGal);
}

echo "<pre>";
print_r($postData['galeria_og']);
echo "</pre>";

echo "<pre>";
print_r($fileData);
echo "</pre>";

// echo "<pre>";
// print_r($postData);
// echo "</pre>";

try {

    $figura = Figura::productoPorId($id);
    $imagenes = Imagen::get_x_id_producto($id);

    $url ="../img/logo.png";
    
    //Inserta en la tabla pivot "productos_categorias"
    if (isset($postData['categorias']) && !empty($postData['categorias'])) {

        // Limpia las categorías existentes y asigna las nuevas seleccionadas
        Figura::clear_categoria_producto($id);

        foreach ($postData['categorias'] as $categoria_id) {
            Figura::insert_categoria_producto($categoria_id, $id);
        }
    }

    if (!empty($fileData['tmp_name'])) {
        $portada = Imagen::updateImagen($postData['portada_og'], __DIR__ . "/../../img/productos/generales", $fileData);
        Imagen::borrarImagen(__DIR__ . "/../../" . $postData['portada_og']);
    } else {
        $portada = $postData['portada_og'];
    }

    if(!empty($fileDataGal['tmp_name'][0])){
        foreach ($galeriaFiles as $file) {
            Imagen::subirImagen(__DIR__ . "/../../img/productos/generales", $file, $id);
            Imagen::borrarImagen(__DIR__ . "/../../" . $postData['galeria_og']);
        }   
    }

    $figura->edit(
        $postData['nombre'],
        $postData['franquicia_id'],
        $postData['marca_id'],
        $postData['descripcion'],
        $postData['lanzamiento'],
        $postData['novedad'],
        $postData['precio'],
        $postData['bajada']
    );
} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo editar el producto");
    header('Location: ../index.php?sec=admin_catalogo');
}


Alerta::add_alerta("success", "El producto se edito correctamente");
header('Location: ../index.php?sec=admin_catalogo');

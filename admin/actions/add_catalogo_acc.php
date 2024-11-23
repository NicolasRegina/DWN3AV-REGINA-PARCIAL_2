<?php
require_once "../../functions/autoload.php";
//require_once "classes/Imagen.php";

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

$postData = $_POST;
$fileData = $_FILES['portada'];
$galeriaData = $_FILES['galeria'];

echo "<pre>";
print_r($postData);
echo "</pre>";

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

echo "<pre>";
print_r($fileData);
print_r(__DIR__ . "/../../");
echo "</pre>";

// Verificar si 'galeria' es un array o un solo archivo
if (is_array($galeriaData['name'])) {
    // Reorganizar los archivos de la galería
    $galeriaFiles = reArrayFiles($galeriaData);
} else {
    // Convertir a un array de un solo archivo
    $galeriaFiles = array($galeriaData);
}

echo "<pre>";
print_r($galeriaFiles);
echo "</pre>";

// die();

//Primero inserto la img para asi obtener su ID
try {
    $producto_id = Figura::insert(
        $postData['nombre'],
        $postData['precio'],
        $postData['lanzamiento'],
        $postData['descripcion'],
        $postData['novedad'],
        $postData['franquicia_id'],
        $postData['marca_id'],
        $postData['bajada']
    );

    if (isset($postData['categorias']) && !empty($postData['categorias'])) {
        //Inserta en la tabla pivot "productos_categorias"
        foreach ($postData['categorias'] as $categoria_id) {
            Figura::insert_categoria_producto($categoria_id, $producto_id);
        }
    }

    // Inserta la portada
    Imagen::subirImagen(__DIR__ . "/../../img/productos/generales", $fileData, $producto_id);

    // Inserta cada archivo de la galería
    foreach ($galeriaFiles as $file) {
        Imagen::subirImagen(__DIR__ . "/../../img/productos/generales", $file, $producto_id);
    }

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo agregar el producto");
}

header('Location: ../index.php?sec=admin_catalogo');
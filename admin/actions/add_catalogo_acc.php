<?PHP
require_once "../../functions/autoload.php";
//require_once "classes/Imagen.php";

$postData = $_POST;
$fileData = $_FILES['portada'];

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

// esto se paso a la clase Imagen.php
// $nombreOriginal = explode(".", $fileData['name']);
// $extension = end($nombreOriginal);
////$nombreNuevo = time() . ".$extension"; esto devolvera por ej 123451661.jpg
// $nombreNuevo = uniqid() . "." . $extension;

// $archivoSubido = move_uploaded_file($fileData['tmp_name'], __DIR__ . "/../../img/productos/" . $nombreNuevo);
//ahora hay q asignar el nombreNuevo a la propiedad que corresponda el path de la imagen en la base de datos
//hay q crear una clase que haga desde asignar el nombre orignial hasta devolver el nombre nuevo
//esto seria la clase Imagen.php

try {
    //revisar el portada donde se debe asignar en Figura, ya que este esta indexado
    $portada = Imagen::subirImagen(__DIR__ . "/../../", $fileData);
    $idComic = Figura::insert(
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
    die("No se pudo agregar el producto");
}


header('Location: ../index.php?sec=admin_catalogo');

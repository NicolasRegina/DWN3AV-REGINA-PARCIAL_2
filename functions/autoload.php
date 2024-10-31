<?php
session_start();

//  echo "<pre>";
//  print_r($_SESSION);
//  echo "</pre>";
function autoloadClasses($nombreClase)
{
    // echo "<p> SE SOLICITÓ UNA CLASE NO INCLUIDA: $nombreClase <p>";

    $archivoClase = __DIR__ . "/../classes/$nombreClase.php";
    
    //echo "<p>ESTA ES NUESTRA RUTA:  $archivoClase</p>";
    
    if (file_exists($archivoClase)) {
        require_once $archivoClase;
    } else {
        die("No se pudo cargar la clase: $nombreClase en la ruta: $archivoClase");
    }
}

spl_autoload_register('autoloadClasses');

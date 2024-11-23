<?php
require_once "../../functions/autoload.php";

$name = $_POST['nombre'] ?? FALSE;

echo "<pre>";
print_r($name);
echo "</pre>";

try {

    if (!$name) {
        throw new Exception("Nombre de marca no proporcionado.");
    }
    Marca::insertMarca($name);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo agregar la marca");
}

header('Location: ../index.php?sec=admin_marca');
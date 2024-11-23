<?php
require_once "../../functions/autoload.php";

$name = $_POST['nombre'] ?? FALSE;

echo "<pre>";
print_r($name);
echo "</pre>";

try {

    if (!$name) {
        throw new Exception("Nombre de categoría no proporcionado.");
    }
    Categoria::insertCategoria($name);

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo agregar la categoría");
}

header('Location: ../index.php?sec=admin_categoria');
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
    Alerta::add_alerta("danger", "No se pudo agregar la categoría");
    header('Location: ../index.php?sec=admin_categoria');
}

Alerta::add_alerta("success", "La categoría se agregó correctamente");
header('Location: ../index.php?sec=admin_categoria');
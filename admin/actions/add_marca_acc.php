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
    Alerta::add_alerta("danger", "No se pudo agregar la marca");
    header('Location: ../index.php?sec=admin_marca');
}

Alerta::add_alerta("success", "La marca se agregó correctamente");
header('Location: ../index.php?sec=admin_marca');
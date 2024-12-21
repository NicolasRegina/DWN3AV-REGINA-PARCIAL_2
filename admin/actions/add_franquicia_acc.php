<?php
require_once "../../functions/autoload.php";

$name = $_POST['nombre'] ?? FALSE;

echo "<pre>";
print_r($name);
echo "</pre>";

try {

    if (!$name) {
        throw new Exception("Nombre de franquicia no proporcionado.");
    }
    Franquicia::insertFranquicia($name);

} catch (\Exception $e) {
    Alerta::add_alerta("danger", "No se pudo agregar la franquicia");
    header('Location: ../index.php?sec=admin_franquicia');
}

Alerta::add_alerta("success", "La franquicia se agregó correctamente");
header('Location: ../index.php?sec=admin_franquicia');
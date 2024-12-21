<?PHP
require_once "../../functions/autoload.php";

Autenticacion::log_out();


Alerta::add_alerta("warning", "El usuario se deslogueo correctamente");
header('location: ../../index.php?sec=login');
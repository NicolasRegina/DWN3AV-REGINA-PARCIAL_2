<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;


if(!empty($postData)){
    Carrito::actualizar_cantidades($postData['q']);
    header('location: ../../index.php?sec=carrito');
}
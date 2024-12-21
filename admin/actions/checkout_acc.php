<?PHP
require_once "../../functions/autoload.php";

$items = Carrito::get_carrito();
$userID = $_SESSION['loggedIn']['id'] ?? FALSE;

try {

    if ($userID) {

        $datosCompra = [
            "id_usuario" => $userID,
            "fecha" => date("Y-m-d"),
            "importe" => Carrito::precio_total()
        ];

        $detalleCompra = [];

        foreach ($items as $key => $value) {
            $detalleCompra[$key] = $value['cantidad'];
        }

        Checkout::insert_checkout_data($datosCompra, $detalleCompra);
        Carrito::clear_items();

        Alerta::add_alerta('success', "Su compra se realizó correctamente, nos estaremos contactando por mail para pactar el envio");
        header('location: ../../index.php?sec=inicio');
    } else {
        Alerta::add_alerta('warning', "Su sessión expiró. Por favor, ingrese nuevamente");
        header('location: ../../index.php?sec=login');
    }
} catch (Exception $e) {
    Alerta::add_alerta('warning', "No se pudo finalizar la compra");
}

header('location: ../../index.php?sec=inicio');
<?PHP
class Carrito
{

    /**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    public static function add_item(int $productoID, int $cantidad)
    {
        $itemData = Figura::productoPorId($productoID);

        if ($itemData) {
            $_SESSION['carrito'][$productoID] = [
                'producto' => $itemData->getPersonaje(),
                'portada' => $itemData->getPortada()->getUrl(),
                'precio' => $itemData->getPrecio(),
                'cantidad' => $cantidad
            ];
        }
    }

        /**
     * Elimina un item del carrito de compras
     * @param int $productoID El id del producto a eliminar
     */
    public static function remove_item(int $productoID)
    {
        if (isset($_SESSION['carrito'][$productoID])) {
            unset($_SESSION['carrito'][$productoID]);
        }
    }

    /**
     * Vacia el carrito de compras
     */
    public static function clear_items()
    {
        $_SESSION['carrito'] = [];
    }

        /**
     * Actualiza las cantidades de los ids provistos
     * @param array $cantidades Array asociativo con las cantidades de cada ID
     */
    public static function actualizar_cantidades(array $cantidades)
    {
        foreach ($cantidades as $key => $value) {
            if (isset($_SESSION['carrito'][$key])) {
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }
    }

        /**
     * devuelve el contenido del carrito de compras actual
     */
    public static function get_carrito(): array
    {
        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        } else {
            return [];
        }
    }


        /**
     * Devuelve el precio total actual del carrito de compras
     */
    public static function precio_total(): float
    {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }
        return $total;
    }

}
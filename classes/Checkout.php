<?PHP
class Checkout
{

    /**
     * Inserta los datos de una compra en la BBDD
     * @param array $datosCompra Array con los datos de la compra
     * @param array $detailsData Array con los productos incluidos en la compra
     */
     public static function insert_checkout_data(array $datosCompra, array $detailsData)
     {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :usuario_id, :importe, :fecha)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "usuario_id" => $datosCompra['usuario_id'], 
            "importe" => $datosCompra['importe'],
            "fecha" => $datosCompra['fecha']
        ]);

        $isertedID = $conexion->lastInsertId();

        foreach ($detailsData as $key => $value) {
            $query = "INSERT INTO items_x_compras VALUES (NULL, :compra_id, :producto_id, :cantidad)";
        
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "compra_id" => $isertedID, 
                "producto_id" => $key, 
                "cantidad" => $value
            ]);
        }
     }

}

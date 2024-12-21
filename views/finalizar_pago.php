<?PHP
$items = Carrito::get_carrito();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>
<div class="container">

    <h1 class="text-center mb-5 fw-bold">Finalizar Pago</h1>

    <div class="border rounded p-3 mb-4">

        <div class="row">


            <div class="col-12 ">

                <section>
                    <h2>Datos de Usuario</h2>
                    <p class="h5 mb-3"><strong>Nombre de usuario: </strong><?= $_SESSION['loggedIn']['nombre_completo'] ?></p>
            

                </section>


                <section>
                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">Datos del producto</th>
                                <th scope="col" width="15%">Cantidad</th>
                                <th class="text-end" scope=" col" width="15%">Precio Unitario</th>
                                <th class="text-end" scope="col" width="15%">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP foreach ($items as $key => $item) { ?>
                                <tr>

                                    <td class="align-middle">
                                        <h2 class="h5"><?= $item['producto'] ?></h2>
                                    </td>
                                    <td class="align-middle">
                                        <p><?= $item['cantidad'] ?></p>
                                    </td>
                                    <td class="text-end align-middle">
                                        <p class="h5 py-3">$<?= number_format($item['precio'], 2, ",", ".") ?></p>
                                    </td>
                                    <td class="text-end align-middle">
                                        <p class="h5 py-3"> $<?= number_format($item['cantidad'] * $item['precio'], 2, ",", ".") ?></p>
                                    </td>

                                </tr>
                            <?PHP } ?>

                            <tr>
                                <td colspan="3" class="text-end">
                                    <h2 class="h5 py-3">Total:</h2>
                                </td>
                                <td class="text-end">

                                    <p class="h5 py-3">$<?= number_format(Carrito::precio_total(), 2, ",", ".") ?></p>

                                </td>
                                <td></td>
                            </tr>
                        </tbody>



                    </table>
                </section>


                <a href="admin/actions/checkout_acc.php" role="button" class="btn btn-primary w-100">Pagar</a>


            </div>


        </div>

    </div>

</div>
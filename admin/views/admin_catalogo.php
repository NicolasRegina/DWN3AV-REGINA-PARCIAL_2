<?php
$catalogo = Figura::catalogoCompleto();
// var_dump($catalogo[0]->getCategoria());

?>

<div class=" d-flex justify-content-center p-5">
    <div>
    <div class="row my-5">
    <div class="col">

        <h2 class="text-center mb-5 fw-bold">Administración de Catalogo</h2>
        <div class="row mb-5 d-flex align-items-center">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="15%">Portada</th>
                        <th scope="col" width="15%">Personaje</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Bajada</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Fecha de Lanzamiento</th>
                        <th scope="col">Franquicia</th>
                        <th scope="col">Marca</th>
                        <!-- <th scope="col">Categoria</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($catalogo as $C) { ?>
                        <tr>
                            <td><img src="../<?= $C->getPortada()->getUrl() ?>" alt="Imágen de <?= $C->getPersonaje() ?>" class="img-fluid rounded shadow-sm"></td>
                            <td><?= $C->getPersonaje() ?></td>
                            <td><?= $C->getDescripcion() ?></td>
                            <td><?= $C->bajada_reducida() ?></td>
                            <td>$<?= $C->precio_formateado() ?></td>
                            <td><?= $C->getFechaLanzamiento() ?></td>
                            <td><?= $C->getFranquicia()->getNombre() ?></td>
                            <td><?= $C->getMarca()->getNombre() ?></td>
                            <td>
                                <?php foreach ($C as $cat) { ?>
                                    <?= $cat->getCategoria(); ?>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="index.php?sec=edit_catalogo&id=<?= $C->getId() ?>" role="button" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                                <a href="index.php?sec=delete_catalogo&id=<?= $C->getId() ?>" role="button" class="d-block btn btn-sm btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_catalogo" class="btn btn-primary mt-5"> Cargar nuevo producto</a>
        </div>


    </div>
</div>


    </div>
</div>
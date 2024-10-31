<?php
$id = $_GET['id'] ?? FALSE;

$figura = Figura::productoPorId($id);

// var_dump($figura);
?>

<!-- DETALLE PRODUCTO -->
<section id="details" class="product-details">
    <div class="container">
        <?php if (!empty($figura)) { ?>
            <div class="p-4 bg-body-tertiary rounded-3 opacity-bg">
                <h2 class="mx-5"><?= $figura->getDescripcion(); ?> </h2>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <img src="<?= $figura->getPortada()->getUrl(); ?>" class="img-fluid rounded-start border-end" alt="Portada de <?= $figura->getPersonaje(); ?>">
                    </div>
                    <div class="col-md-8">
                        <p class="fs-5"><?= $figura->getBajada(); ?></p>
                                <span class="d-block"><strong>Precio:</strong> $<?= number_format($figura->getPrecio(), 2); ?></span>
                                <span class="d-block"><strong>Fecha de Lanzamiento:</strong> <?= date('d-m-Y', strtotime($figura->getFechaLanzamiento())); ?></span>
                                <span class="d-block"><strong>Franquicia:</strong> <?= $figura->getFranquicia()->getNombre(); ?></span>
                                <span class="d-block"><strong>Marca:</strong> <?= $figura->getMarca()->getNombre(); ?></span>
                                <!-- <span class="d-block"><strong>Categoría:</strong></span> -->
                                
                                <?php if ($figura->getNovedad()) { ?>
                                    <span class="badge bg-warning text-dark">Novedad</span>
                                <?php } ?>
                                <br>
                                <a href="#" class="btn btn-primary mt-3" style="width: 31%;">Agregar al carrito</a>      
                    </div>
                </div>
            </div>
            <!-- Galería de Imágenes -->
            <div class="bg-body-tertiary rounded-3 opacity-bg mt-3">
                <h3 class="text-center pt-3">Galería de Imágenes</h3>
                <div class="image-gallery pb-4 mx-5">
                    <?php foreach ($figura->getImagenes() as $index => $imagen) { ?>
                        <img src="<?= $imagen; ?>" alt="Imagen de <?= $figura->getPersonaje(); ?>" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#modal<?= $index; ?>">
                    <?php } ?>
                </div>
            </div>

            <!-- Modales para Imágenes -->
            <?php foreach ($figura->getImagenes() as $index => $imagen) { ?>
                <div class="modal fade" id="modal<?= $index ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $index; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <img src="<?= $imagen; ?>" alt="Imagen de <?= $figura->getPersonaje(); ?>" class="img-fluid">
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col">
                <h2 class="text-center m-5">No se encontró el producto deseado.</h2>
            </div>
        <?php } ?>


        <hr>

        <div class="p-4 bg-body-tertiary rounded-3 opacity-bg">
            <!-- Medios de Pago -->
            <h3>Medios de Pago</h3>
            <p>Aceptamos pagos con tarjeta de crédito, débito, y PayPal.</p>
    
            <!-- Financiación -->
            <h3>Financiación</h3>
            <p>Ofrecemos opciones de financiación a plazos con tasas de interés competitivas. Consulta con nuestro equipo para más detalles.</p>
        </div>
</section>
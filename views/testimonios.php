<?PHP
require_once 'classes/Testimonios.php';
$objTestimonio = new Testimonio();
$testimonios = $objTestimonio->testimoniosCompleto();
?>

<!-- SECTION TESTIMONIOS -->
<section id="testimonios" class="section">
    <div class="p-4 bg-body-tertiary rounded-3">
        <div class="container pt-5 pb-2 nos-container">
            <h2 class="display-6 sm-h2 text-center">Testimonios</h2>
            <div class="card-container mt-5">

                <?php if (!empty($testimonios)) { ?>
                    <p class="text-center fs-4">Estos son algunos de los testimonios de <strong class="red-color">nuestros clientes</strong>.</p>

                    <div class="card-container mt-5">
                        <!-- TODO: Agregar un carousel para los testimonios -->
                        <?PHP foreach ($testimonios as $testimonio) { ?>
                            <div class="card test-width mb-5">
                                <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="img-fluid test-img" src="<?= $testimonio-> getImagen() ?>" alt="foto de <?= $testimonio->getNombre() ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <strong class="card-title"><?= $testimonio-> nombreCompleto()?></strong>
                                    <p class="card-text"><?= $testimonio-> getTestimonio() ?></p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?PHP } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
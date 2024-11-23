<?php
    $id = $_GET['id'] ?? FALSE;
    $franquicia = Franquicia::get_x_id($id);
?>
<!-- <pre>
    <?php print_r($franquicia->getNombre()); ?>
</pre> -->

<div class="d-flex justify-content-center px-5">
    <div>
        <div class="row my-5">
            <div class="col">
                <h2 class="text-center mb-5 fw-bold">Editar Franquicia</h2>
                <div class="row mb-5 d-flex align-items-center">
                    <form class="row g-3" action="actions/edit_franquicia_acc.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 container">
                            <div class="row">
                                <label for="nombre" class="form-label col">Nombre de Franquicia</label>
                                <input type="text" class="form-control col mx-2" style="width: auto;" id="nombre" name="nombre" value="<?= $franquicia->getNombre() ?>" required>
                                <input type="hidden" name="id" value="<?= $franquicia->getId() ?>">
                                <button type="submit" class="btn btn-warning col mx-2">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
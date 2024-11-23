<?PHP
$id = $_GET['id'] ?? FALSE;
$figura = Figura::productoPorId($id);

$imagenes = Imagen::get_x_id_producto($id);
$franquicias = Franquicia::lista_completa();
$marcas = Marca::lista_completa();
$categorias = Categoria::lista_categorias();
$categoriasSelec = Categoria::categorias_x_producto_value($id);

// echo "<pre>";
// print_r($categoriasSelec);
// echo "</pre>";

// echo "<pre>";
// print_r($figura->getPortada()->getUrl());
// print_r($imagenes);
// echo "</pre>";

// echo "<pre>";
// print_r($imagenes);
// echo "</pre>";

// echo "<pre>";
// print_r($figura->getImagenes());
// echo "</pre>";


?>

<div class="row my-5">
    <div class="col">

        <h2 class="text-center mb-5 fw-bold">Edición de datos de: <span class="text-danger"><?= $figura->getPersonaje() ?><span></h2>
        <div class="row mb-5 d-flex align-items-center">

            <form class="row g-3" action="actions/edit_catalogo_acc.php?id=<?= $figura->getId() ?>" method="POST" enctype="multipart/form-data">

                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= $figura->getPersonaje() ?>">
                </div>

                <!-- Franquicia -->
                <div class="col-md-3 mb-3">
                    <label for="franquicia_id" class="form-label">Franquicia</label>
                    <select class="form-select" name="franquicia_id" id="franquicia_id" required>
                        <option value="" selected disabled>Elija una opción</option>
                        <?php foreach ($franquicias as $franquicia) { ?>
                            <option  
                                value="<?= $franquicia->getId() ?>" <?= $franquicia->getId() == $figura->getFranquicia()->getId() ? "selected" : "" ?>>
                                <?= $franquicia->getNombre() ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Marca -->
                <div class="col-md-3 mb-3">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select class="form-select" name="marca_id" id="marca_id" required>
                        <option value="" selected disabled>Elija una opción</option>
                        <?PHP foreach ($marcas as $marca) { ?>
                            <option 
                                value="<?= $marca->getId() ?>" <?= $marca->getId() == $figura->getFranquicia()->getId() ? "selected" : "" ?>>
                                <?= $marca->getNombre() ?>
                            </option>
                        <?PHP } ?>
                    </select>
                </div>

                <!-- Portada Actual -->
                <div class="col-md-4 mb-3">
                    <label for="portada_og" class="form-label">Portada Actual</label>
                    <img src="../<?= $figura->getPortada()->getUrl() ?>" alt="Imágen Illustrativa de <?= $figura->getPersonaje() ?>" class="img-fluid rounded shadow-sm d-block">
                    <input class="form-control" type="hidden" id="portada_og" name="portada_og" required value="<?= $figura->getPortada()->getUrl() ?>">
                </div>

                <!-- Descripción -->
                <div class="col-md-4 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?= $figura->getDescripcion() ?>">
                </div>

                <!-- Reemplazar Portada -->
                <div class="col-md-4 mb-3">
                    <label for="portada" class="form-label">Reemplazar Portada</label>
                    <input class="form-control" type="file" id="portada" name="portada">
                </div>

                <!-- Lanzamiento -->
                <div class="col-md-4 mb-3">
                    <label for="lanzamiento" class="form-label">Fecha de Lanzamiento</label>
                    <input type="date" class="form-control" id="lanzamiento" name="lanzamiento" required value="<?= $figura->getFechaLanzamiento() ?>">
                </div>

                <!-- Novedad -->
                <div class="col-md-2 mb-3">
                    <label for="novedad" class="form-label">¿Es Novedad?</label>
                    <div class="form-check">
                        <input type="hidden" name="novedad" value="0">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="novedad" 
                            id="novedad_<?= $figura->getId() ?>" 
                            value="1"
                            <?= $figura->getNovedad() == 1 ? 'checked' : '' ?>
                        >
                        <label class="form-check-label mb-2" for="novedad_<?= $figura->getId() ?>">Si</label>
                    </div>
                </div>

                <!-- Precio -->
                <div class="col-md-2 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required value="<?= $figura->getPrecio() ?>">
                </div>

                <!-- Categorías -->
                <div class="col-md-4 mb-3">
                    <label class="form-label d-block">Categorías</label>
                    <?PHP                    
                    foreach ($categorias as $C) {
                    ?>
                        <div class="form-check form-check-inline">
                            <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="categorias[]" 
                            id="categorias_<?= $C->getId() ?>" 
                            value="<?= $C->getId() ?>"       
                            <?= in_array($C->getId(), $categoriasSelec) ? 'checked' : '' ?>       
                            >                     
                            <label class="form-check-label mb-2" for="categorias_<?= $C->getId() ?>"><?= $C->getNombre() ?></label>
                        </div>
                    <?PHP } ?>
                </div>

                <pre></pre>

                <!-- Galería de Imágenes -->
                <div class="col-md-9 mb-3 bg-body-tertiary rounded-3 opacity-bg mt-3">
                    <label for="galeria_og" class="text-center pt-3">Galería de Imágenes</label>
                    <div class="image-gallery pb-4 mx-5">
                        <?php foreach ($figura->getImagenes() as $index => $imagen) { ?>
                            <img src="../<?= $imagen ?>" alt="Imagen de <?= $figura->getPersonaje(); ?>" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#modal<?= $index; ?>">
                            <input type="hidden" name="galeria_og[]" value="<?= $imagen; ?>">
                        <?php } ?>
                    </div>
                </div>

                <!-- Reemplazar Imagenes de galería -->
                <div class="col-md-3 mb-3">
                    <label for="galeria" class="form-label">Reemplazar Galería</label>
                    <input class="form-control" type="file" id="galeria" name="galeria[]" multiple>
                </div>

                <!-- Bajada -->
                <div class="col-md-12 mb-3">
                    <label for="bajada" class="form-label">Bajada</label>
                    <textarea class="form-control" id="bajada" name="bajada" rows="7"><?= $figura->getBajada() ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">Editar</button>
            </form>
        </div>
    </div>
</div>
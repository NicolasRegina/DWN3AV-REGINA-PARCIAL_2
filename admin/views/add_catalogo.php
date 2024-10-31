<?PHP

$franquicias = Franquicia::lista_completa();
$marcas = Marca::lista_completa();
$categorias = Categoria::lista_completa();

// var_dump($franquicias);
?>

<div class="row my-5">
    <div class="col">

        <h2 class="text-center mb-5 fw-bold">Agregar un nuevo producto<span></h2>
        <div class="row mb-5 d-flex align-items-center">

            <form class="row g-3" action="actions/add_catalogo_acc.php" method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="franquicia_id" class="form-label">Franquicia</label>
                    <select class="form-select" name="franquicia_id" id="franquicia_id" required>
                        <option value="" selected disabled>Elija una opción</option>
                        <?php foreach ($franquicias as $franquicia) { ?>
                            <option 
                                value="<?= $franquicia->getId() ?>"><?= $franquicia->getNombre() ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select class="form-select" name="marca_id" id="marca_id" required>
                        <option value="" selected disabled>Elija una opción</option>
                        <?PHP foreach ($marcas as $M) { ?>
                            <option 
                                value="<?= $M->getId() ?>"><?= $M->getNombre() ?>
                            </option>
                        <?PHP } ?>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="portada" class="form-label">Agregar Portada</label>
                    <input class="form-control" type="file" id="portada" name="portada">
                </div>


                <div class="col-md-4 mb-3">
                    <label for="lanzamiento" class="form-label">Fecha de Lanzamiento</label>
                    <input type="date" class="form-control" id="lanzamiento" name="lanzamiento" required">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="lanzamiento" class="form-label">¿Es Novedad?</label>
                    <div class="form-check">
                        <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="novedad" 
                        id="novedad" 
                        value="false"
                        >
                        <label class="form-check-label mb-2" for="novedad"></label>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                <label class="form-label d-block">Categorías</label>
                <?PHP                    
                foreach ($categorias as $C) {
                ?>
                    <div class="form-check form-check-inline">
                        <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="categorias[]" 
                        id="categorias" 
                        value=""                            
                        <label class="form-check-label mb-2" for="categorias_<?= $C->getId() ?>"><?= $C->getNombre() ?></label>
                    </div>
                    <?PHP } ?>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required">
                </div>

                <!-- Agregar Galería de Imágenes -->
                <div class="col-md-12 mb-3">
                    <label for="galeria" class="form-label">Agregar Galería</label>
                    <input class="form-control" type="file" id="galeria" name="galeria">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="bajada" class="form-label">Bajada</label>
                    <textarea class="form-control" id="bajada" name="bajada" rows="7"></textarea>
                </div>


                <button type="submit" class="btn btn-warning">Agregar</button>
            </form>
        </div>
    </div>
</div>
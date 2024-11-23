<div class="d-flex justify-content-center px-5">
    <div>
        <div class="row my-5">
            <div class="col">
                <h2 class="text-center mb-5 fw-bold">Crear Nueva Franquicia</h2>
                <div class="row mb-5 d-flex align-items-center">
                    <form class="row g-3" action="actions/add_franquicia_acc.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 container">
                            <div class="row">
                                <label for="nombre" class="form-label col">Nombre de Franquicia</label>
                                <input type="text" class="form-control col mx-2" id="nombre" name="nombre" required>
                                <button type="submit" class="btn btn-warning col mx-2">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
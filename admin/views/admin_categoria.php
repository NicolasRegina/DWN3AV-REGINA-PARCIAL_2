<?php
    $categorias = Categoria::lista_categorias();

    // echo "<pre>";
    // print_r($categorias);
    // echo "</pre>";
?>

<div class="d-flex justify-content-center px-5">
    <div>
        <div class="row my-5">
            <div class="col">
                <h2 class="text-center mb-5 fw-bold">Administración de Categorias</h2>

                <div>
                    <?= Alerta::get_alertas(); ?>
                </div>

                <div class="row mb-5 d-flex align-items-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="80%">Nombre Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categorias as $c) { ?>
                                <tr>
                                    <td><?= $c->getNombre() ?></td>
                                    <td>
                                        <a href="index.php?sec=edit_categoria&id=<?= $c->getId() ?>" role="button" class="d-block btn btn-sm btn-warning mb-1" style="color:white;">Editar</a>
                                        <button onclick="openModal('delete', <?= $c->getId() ?>)" class="d-block btn btn-sm btn-danger px-4">Eliminar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="index.php?sec=add_categoria" class="btn btn-primary mt-5"> Cargar nueva categoria</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content py-3">
            <div class="modal-body" id="confirmMessage">
            </div>
            <div>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="confirmButton">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let actionUrl = '';

    function openModal(action, id) {
        let message = '';

        if (action === 'delete') {
            message = '¿Estás seguro de que deseas eliminar esta categoria?';
            actionUrl = `actions/delete_categoria_acc.php?id=${id}`;
        }

        document.getElementById('confirmMessage').innerText = message;
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        confirmModal.show();
    }

    document.getElementById('confirmButton').addEventListener('click', function() {
        window.location.href = actionUrl;
    });
</script>
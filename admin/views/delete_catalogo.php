<?PHP
$id = $_GET['id'] ?? FALSE;
$figura = Figura::productoPorId($id);
?>

<div class="row my-5 g-3">
	<h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar este producto?</h1>
	<div class="col-12 col-md-6">
		<img src="../<?= $figura->getPortada()->getUrl() ?>" alt="Imágen de <?= $figura->getPersonaje() ?>" class="img-fluid rounded shadow-sm d-block mx-auto mb-3">
	</div>

	<div class="col-12 col-md-6">

		<h2 class="fs-6">Titulo</h2>
		<p><?= $figura->getPersonaje() ?></p>

		<a href="actions/delete_catalogo_acc.php?id=<?= $figura->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>



</div>
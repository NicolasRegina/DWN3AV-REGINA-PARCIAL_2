<?PHP

$fraSeleccionada = isset($_GET['fra']) ? $_GET['fra'] : FALSE;
$marSeleccionada = isset($_GET['mar']) ? $_GET['mar'] : FALSE;
$catSeleccionada = isset($_GET['cat']) ? $_GET['cat'] : FALSE;
$newSeleccionada = isset($_GET['new']) ? $_GET['new'] : FALSE;


$objFigura = new Figura();

//se fija si se seleccionó una franquicia, una marca o nada y en base a eso muestra el Catálogo
if($fraSeleccionada) {
    $catalogo = Figura::catalogoPorFranquicia($fraSeleccionada);
    $franquicia = $objFigura->nombreCatalogoPorFranquicia($fraSeleccionada);
} elseif($marSeleccionada) {
    $catalogo = Figura::catalogoPorMarca($marSeleccionada);
    $marca = $objFigura->nombreCatalogoPorMarca($marSeleccionada);
} elseif($catSeleccionada) {
    $catalogo = Figura::catalogoPorCategoria($catSeleccionada);
    $categoria = $objFigura->nombreCatalogoPorCategoria($catSeleccionada);
} elseif($newSeleccionada) {
    $catalogo = Figura::catalogoNovedades($newSeleccionada);
} else {
    $catalogo = Figura::catalogoCompleto();
}

  // var_dump($catalogo);

?>
<!-- CAROUSEL -->
<header class="header-section">
  <div id="carouselSlidesHeader" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="index.php?sec=catalogo&mar=1" target="_blank" rel="noopener noreferrer">
          <img src="img/banners/banner_inicio.jpg" class="d-block w-100" alt="imagen de Banpresto">
        </a>
      </div>
      <div class="carousel-item">
        <a href="index.php?sec=catalogo&mar=3" target="_blank" rel="noopener noreferrer">
          <img src="img/banners/banner_inicio-2.jpg" class="d-block w-100" alt="imagen de Tsume">
        </a>
      </div>
      <div class="carousel-item">
        <a href="index.php?sec=catalogo&mar=2" target="_blank" rel="noopener noreferrer">
          <img src="img/banners/banner_inicio-3.jpg" class="d-block w-100" alt="imagen de Banpresto">
        </a>
      </div>
    <div class="carousel-item">
      <a href="index.php?sec=catalogo&mar=4" target="_blank" rel="noopener noreferrer">
        <img src="img/banners/banner_inicio-4.jpg" class="d-block w-100" alt="imagen de Good Smile Company">
      </a>
    </div>
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselSlidesHeader" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Catalogo 1"></button>
        <button type="button" data-bs-target="#carouselSlidesHeader" data-bs-slide-to="1" aria-label="Catalogo 2"></button>
        <button type="button" data-bs-target="#carouselSlidesHeader" data-bs-slide-to="2" aria-label="Catalogo 3"></button>
        <button type="button" data-bs-target="#carouselSlidesHeader" data-bs-slide-to="3" aria-label="Catalogo 4"></button>
    </div>
  </div>
</header>

<!-- SECTION CATALOGO -->
<section class="section">
  <div class="p-4 bg-body-tertiary rounded-3">
    <div class="container pt-5 pb-2 nos-container">
      
      <?PHP if (!empty($catalogo)) { ?>
        <div class="col-inner text-center">
          <?php if ($fraSeleccionada) { ?>
            <h2 class="display-6">Catálogo - Franquicia <strong class="red-color"> <?= $franquicia; ?> </strong></h2>
            <p class="m-5 fs-4">Las franquicias más importantes, están en <strong class="red-color">Get Geek</strong></p>
          <?PHP } elseif ($marSeleccionada) { ?>
            <h2 class="display-6">Catálogo - Marca <strong class="red-color"> <?= $marca; ?> </strong></h2>
            <p class="m-5 fs-4">Las mejores marcas están en <strong class="red-color">Get Geek</strong></p>
          <?PHP } elseif ($catSeleccionada) { ?>
            <h2 class="display-6">Catálogo - Categoría <strong class="red-color"> <?= $categoria; ?> </strong></h2>
            <p class="m-5 fs-4">Explora las diferentes categorías que tenemos en <strong class="red-color">Get Geek</strong></p>
          <?PHP } elseif ($newSeleccionada) { ?>
            <h2 class="display-6">Catálogo - Nuevos Productos</h2>
            <p class="m-5 fs-4">Las últimas novedades en productos están en <strong class="red-color">Get Geek</strong></p>
          <?PHP } else { ?>
            <h2 class="display-6">Catálogo Completo</h2>
            <p class="m-5 fs-4">La mayor variedad de productos y la mejor calidad está en <strong class="red-color">Get Geek</strong></p>
          <?PHP } ?>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 g-4">
          <?php foreach ($catalogo as $figura) { ?>
            <div class="col">
              <div class="card h-100">
                <a href="index.php?sec=detalle_producto&id=<?= $figura->getId() ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                  <img src="<?= $figura->getPortada()->getUrl() ?>" class="card-img-top" alt="portada de <?= $figura->getPersonaje() ?>">
                </a>
                <div class="card-body">
                  <h3 class="card-title"><?= $figura->getPersonaje() ?></h3>
                  <p class="card-text fs-4 text-center" style="background: #ffc10754;">$<?= $figura->precio_formateado() ?></p>
                </div>
                <a href="index.php?sec=detalle_producto&id=<?= $figura->getId() ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none card-footer red-color">
                 
                  <div class="text-body"><strong>Agregar al carrito</strong></div>
                  
                </a>
              </div>
            </div>
          <?PHP } ?>
        </div>

      <?php } else { ?>
        <div class="row">
          <p class="col-12 text-center h2"> <strong class="red-color">No se encontraron productos</strong></p>
        </p>
      <?php }  ?>
    </div>
  </div>
</section>

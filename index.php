<?PHP
require_once "functions/autoload.php";

$franquicias = Franquicia::lista_completa();
$marcas = Marca::lista_completa();
$categorias = Categoria::lista_categorias();

// Arrays de prueba para mostrar en el menú desplegable
// var_dump($categorias);

// $franquicias = [
//   ['id' => 1, 'nombre' => 'Dragon Ball'],
//   ['id' => 2, 'nombre' => 'My Hero Academy'],
//   ['id' => 3, 'nombre' => "Jojo's Bizarre Adventure"]
// ];

// $marcas = [
//   ['id' => 1, 'nombre' => 'Bandai'],
//   ['id' => 2, 'nombre' => 'Banpresto'],
//   ['id' => 3, 'nombre' => 'Tsume'],
//   ['id' => 4, 'nombre' => 'Good Smile Company'],
//   ['id' => 4, 'nombre' => 'Ivrea'],
//   ['id' => 4, 'nombre' => 'Otros']
// ];

// $categorias = [
//   ['id' => 1, 'nombre' => 'Indumentaria'],
//   ['id' => 2, 'nombre' => 'Manga'],
//   ['id' => 3, 'nombre' => 'Figuras'],
//   ['id' => 5, 'nombre' => 'Heroes']
// ];

// Array asociativo de secciones validas

$secciones_validas = [
    "inicio" => [
        "titulo" => "Bienvenidos"
    ], 
    "detalle_producto" => [
      "titulo" => "Detalle de producto"
    ],
    "catalogo" => [
      "titulo" => "Nuestro catálogo"
    ],
    "testimonios" => [
      "titulo" => "Testimonios"
    ],
    "contacto" => [
      "titulo" => "Contacto"
    ],
    "enviar_formulario" => [
      "titulo" => "Datos formulario"
    ],
    "login" => [
      "titulo" => "Iniciar Sesión"
    ]
];

// Verifica si el parámetro 'sec' está presente en la URL. Si está asigna su valor a la variable $seccion, de lo contrario, establece $seccion con el valor 'inicio'.
$seccion = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';

// Verifica si la variable $seccion existe como una key en el array $secciones_validas.
if (!array_key_exists($seccion, $secciones_validas)) {
    $vista = "404";
    $titulo = "404: Página no encontrada";
} else {
    $vista = $seccion;
    $titulo = $secciones_validas[$seccion]['titulo'];
}

$userData = $_SESSION['loggedIn'] ?? FALSE;

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get Geek - Únicos, como tu colección - <?= $titulo ?></title>

    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FONTS GOOGLE -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito&display=swap">

    <!-- FAVICON -->
    <link rel="icon" href="img/logo.png" type="image/x-icon">

  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm sticky-top rounded-bottom">
      <div class="container">
        <a class="navbar-brand font-zero" href="index.php">
          <img src="img/logo.png" alt="Logo Get Geek" height="70">
          Get Geek
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav" aria-controls="topnav" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="topnav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Inicio -->
            <li class="nav-item"><a class="nav-link" href="index.php?sec=inicio">Inicio</a></li>
            <!-- Catalogo -->
            <li class="nav-item"><a class="nav-link" href="index.php?sec=catalogo">Catálogo</a></li>
            <!-- Franquicia -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Franquicias</a>
              <ul class="dropdown-menu nav-show nav-li-back">
              <?PHP foreach ($franquicias as $fra) { ?>

                <li class="nav-item">
                  <a class="nav-link" href="index.php?sec=catalogo&fra=<?= $fra->getId() ?>"><?= $fra->getNombre() ?></a>
                </li>

              <?PHP } ?>
              </ul>
            </li>
            <!-- Marca -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Marcas</a>
              <ul class="dropdown-menu nav-show nav-li-back">
              <?PHP foreach ($marcas as $mar) { ?>

                <li class="nav-item">
                  <a class="nav-link" href="index.php?sec=catalogo&mar=<?= $mar->getId() ?>"><?= $mar->getNombre() ?></a>
                </li>

              <?PHP } ?>
              </ul>
            </li>
            <!-- Categorias -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
              <ul class="dropdown-menu nav-show nav-li-back">
              <?PHP foreach ($categorias as $cat) { ?>

                <li class="nav-item">
                  <a class="nav-link" href="index.php?sec=catalogo&cat=<?= $cat->getId() ?>"><?= $cat->getNombre() ?></a>
                </li>

              <?PHP } ?>
              </ul>
            </li>
            <!-- Novedades -->
            <li class="nav-item"><a class="nav-link" href="index.php?sec=catalogo&new=true">Nuevos Ingresos</a></li>
            <!-- Testimonios -->
            <li class="nav-item"><a class="nav-link" href="index.php?sec=testimonios">Testimonios</a></li>
            <!-- Contacto -->
            <li class="nav-item"><a class="nav-link" href="index.php?sec=contacto">Contacto</a></li>
            <!-- TODO: hacer funcional la sec admin/actions/auth_login.php quitar el d-none del a -->
            <li class="nav-item <?= $userData ? "d-none" : "" ?>">
              <a class="nav-link fw-bold d-none" href="index.php?sec=login">Login</a>
            </li>

            <!-- si el usuario esta logged, se muestra su nombre -->
            <?PHP if ($userData) { ?>
                <li class="nav-item">
                    <a class="nav-link bg-danger text-light rounded me-2" href="#">🙍‍♂️​ <?= $userData['nombre_completo'] ?? "" ?> </a>
                </li>
            <?PHP } ?>

            <!-- TODO: hacer la sec admin/actions/auth_logout.php -->
            <li class="nav-item <?= $userData ? "" : "d-none" ?>">
                <a class="nav-link fw-bold" href="admin/actions/auth_logout.php">Logout <span class="fw-light"></span></a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <h1 style="display: none;">Get Geek</h1>
    <?PHP
    // Incluye el archivo de vista correspondiente al valor de la variable $vista.
    require_once "views/$vista.php";

    ?>

    <!-- Footer -->
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary rounded-3" data-bs-theme="dark">
      <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
          <div class="col-md-3">
            <img class="img-footer" src="img/nicolas_low.jpg" alt="Nicolás Regina">
          </div>
          <div class="col-md-3">
            <h3>Sobre mi</h3>
            <p>Nicolás Regina</p>
            <p>Edad: 31</p>
            <p>Email: nicojregina@gmail.com</p>
          </div>
          <div class="col-md-3">
            <h3>Enlaces Rápidos</h3>
            <ul class="list-unstyled">
              <li><a href="index.php?sec=inicio">Inicio</a></li>
              <li><a href="index.php?sec=catalogo">Catálogo</a></li>
              <li><a href="index.php?sec=testimonios">Testimonios</a></li>
              <li><a href="index.php?sec=contacto">Contacto</a></li>
            </ul>
          </div>
          <div class="col-sm-0 col-md-3">
            <h3>Redes Sociales</h3>
            <ul class="list-unstyled">
              <li><a href="https://www.linkedin.com/in/nicolas-regina/" target="_blank">LinkedIn</a></li>
              <li><a href="https://twitter.com/NicoJRegina" target="_blank">Twitter</a></li>
              <li><a href="https://www.instagram.com/nicosmicus/" target="_blank">Instagram</a></li>
            </ul>
          </div>
        </div>
        <hr>
        <p class="text-center">Nicolás Regina - [DWN3AV] Programación II</p>
      </div>
    </footer>
  </body>
</html>

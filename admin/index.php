<?PHP
require_once "../functions/autoload.php";
//require_once "classes/Imagen.php";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// Array asociativo de secciones validas
//TODO: Agregar views franquicia, marca y categoría con sus actions
$secciones_validas = [ 
    "login" => [
        "titulo" => "Login",
        "restringido" => FALSE
    ],
    "dashboard" => [
        "titulo" => "Panel de Administración",
        "restringido" => TRUE
    ], 
    "admin_catalogo" => [
        "titulo" => "Administración de Catalogo",
        "restringido" => TRUE
    ], 
    "admin_franquicia" => [
        "titulo" => "Administración de Franquicias",
        "restringido" => TRUE
    ], 
    "admin_marca" => [
        "titulo" => "Administración de Marcas",
        "restringido" => TRUE
    ], 
    "admin_categoria" => [
        "titulo" => "Administración de Categorías",
        "restringido" => TRUE
    ], 
    "add_catalogo" => [
        "titulo" => "Agregar una Catalogo",
        "restringido" => TRUE
    ], 
    "edit_catalogo" => [
        "titulo" => "Editar una Catalogo",
        "restringido" => TRUE
    ], 
    "delete_catalogo" => [
        "titulo" => "Eliminar una Catalogo",
        "restringido" => TRUE
    ], 
    "add_franquicia" => [
        "titulo" => "Agregar nueva Franquicia",
        "restringido" => TRUE
    ], 
    "edit_franquicia" => [
        "titulo" => "Editar una Franquicia",
        "restringido" => TRUE
    ], 
    "delete_franquicia" => [
        "titulo" => "Eliminar una Franquicia",
        "restringido" => TRUE
    ], 
    "add_marca" => [
        "titulo" => "Agregar nueva Marca",       
        "restringido" => TRUE
    ], 
    "edit_marca" => [
        "titulo" => "Editar una Marca",
        "restringido" => TRUE
    ],
    "delete_marca" => [
        "titulo" => "Eliminar una Marca",
        "restringido" => TRUE
    ], 
    "add_categoria" => [
        "titulo" => "Agregar nueva Categoría",
        "restringido" => TRUE
    ], 
    "edit_categoria" => [
        "titulo" => "Editar una Categoría",
        "restringido" => TRUE
    ], 
    "delete_categoria" => [
        "titulo" => "Eliminar una Categoría",
        "restringido" => TRUE
    ]    
];

// Verifica si el parámetro 'sec' está presente en la URL. Si está asigna su valor a la variable $seccion, de lo contrario, establece $seccion con el valor 'dashboard'.
$seccion = isset($_GET['sec']) ? $_GET['sec'] : 'dashboard';

if (!array_key_exists($seccion, $secciones_validas)) {

    $vista = "404";
    $titulo = "404 - Página no encontrada";
} else {

    $vista = $seccion;
    //Chequea si el usuario tiene permisos para acceder a la sección
    if ($secciones_validas[$seccion]['restringido']) {
        (new Autenticacion())->verify();
    }

    $titulo = $secciones_validas[$seccion]['titulo'];
}

$userData = $_SESSION['loggedIn'] ?? FALSE;

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get Geek - <?= $titulo ?></title>

    <!-- CSS -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FONTS GOOGLE -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito&display=swap">

    <!-- FAVICON -->
    <link rel="icon" href="../img/logo.png" type="image/x-icon">

  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm sticky-top rounded-bottom">
      <div class="container">
        <a class="navbar-brand font-zero" href="../index.php">
          <img src="../img/logo.png" alt="Logo Get Geek" height="70">
          Panel de Administración
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav" aria-controls="topnav" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="topnav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dashboard -->
                <li class="nav-item"><a class="nav-link" href="index.php?sec=dashboard">Dashboard</a></li>
                <!-- Administrar Catalogo -->
                <li class="nav-item"><a class="nav-link" href="index.php?sec=admin_catalogo">Administrar Catalogo</a></li>
                <!-- Administrar Franquicias -->
                <li class="nav-item"><a class="nav-link" href="index.php?sec=admin_franquicia">Administrar Franquicias</a></li>
                <!-- Administrar Marcas -->
                <li class="nav-item"><a class="nav-link" href="index.php?sec=admin_marca">Administrar Marcas</a></li>
                <!-- Administrar Categorias -->
                <li class="nav-item"><a class="nav-link" href="index.php?sec=admin_categoria">Administrar Categorías</a></li>
                <!-- si el usuario esta logged, se muestra su nombre -->
                <?PHP if ($userData) { ?>
                    <li class="nav-item">
                        <a class="nav-link bg-danger text-light rounded me-2" href="#">🙍‍♂️​ <?= $userData['nombre_completo'] ?? "" ?> </a>
                    </li>
                <?PHP } ?>
                <li class="nav-item <?= $userData ? "" : "d-none" ?>">
                    <a class="nav-link fw-bold" href="actions/auth_logout.php">Logout <span class="fw-light"></span></a>
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
            <img class="img-footer" src="../img/nicolas_low.jpg" alt="Nicolás Regina">
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
              <li><a href="index.php?sec=dashboard">Dashboard</a></li>
              <li><a href="index.php?sec=admin_catalogo">Administrar Catalogo</a></li>
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

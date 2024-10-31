<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;


// echo "<pre>";
// print_r($datosPOST);
// echo "</pre>";

$login = (new Autenticacion())->log_in($datosPOST['username'], $datosPOST['password']);

// echo "<pre>";
// print_r($login);
// echo "</pre>";

if ($login) {

    if($login == "usuario"){ 
        header('location: ../../index.php');
    }else{
        header('location: ../index.php?sec=dashboard');
    }
    
} else {
    header('location: ../../index.php?sec=login');
}


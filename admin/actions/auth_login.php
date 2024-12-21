<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

// echo "<pre>";
// print_r($postData);
// echo "</pre>";

$login = (new Autenticacion())->log_in($postData['username'], $postData['pass']);

// echo "<pre>";
// print_r($login);
// echo "</pre>";

if ($login) {

    if($login === "usuario"){ 
        header('location: ../../index.php');
    }else{
        header('location: ../index.php?sec=dashboard');
    }
    
} else {
    header('location: ../../index.php?sec=login');
}


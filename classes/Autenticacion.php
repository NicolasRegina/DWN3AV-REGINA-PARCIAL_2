<?PHP

class Autenticacion
{

    /**
     * Verifica las credenciales del usuario, y de ser correctas, guarda los datos en la sesión
     * @param string $username El nombre de usuario provisto
     * @param string $password El password provisto
     * @return mixed Devuelve el rol en caso que las credenciales sean correctas, FALSE en caso de que no lo sean y Null en caso que el usuario no se encuentre en la BDD
     */
    public static function log_in(string $usuario, string $password): mixed
    {
        $datosUsuario = Usuario::usuario_x_username($usuario);

        // echo "<pre>";
        // print_r($datosUsuario);
        // echo "</pre>";

        if ($datosUsuario) {

            echo "<p>El usuario ingresado SI se encontró en nuestra base de datos.</p>";

            if (password_verify($password, $datosUsuario->getPassword())) {
                echo "<p>EL PASSWORD ES CORRECTO! LOGUEAR!</p>";

                $datosLogin['username'] = $datosUsuario->getNombre_usuario();
                $datosLogin['nombre_completo'] = $datosUsuario->getNombre_completo();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();

                $_SESSION['loggedIn'] = $datosLogin;

                return $datosLogin['rol'];
            } else {
                echo "<p>EL PASSWORD NO ES CORRECTO!</p>";
                return FALSE;
            }
        } else {
            echo "<p>El usuario ingresado NO se encontró en nuestra base de datos.</p>";
            return NULL;
        }
    }

    /*LOG OUT */
    public static function log_out()
    {

        if (isset($_SESSION['loggedIn'])) {
            unset($_SESSION['loggedIn']);
        };
    }


    /* VERIFICAR CREDENCIALES*/

    public static function verify($admin = TRUE): bool
    {

        if (isset($_SESSION['loggedIn'])) {

            if ($admin) {

                if ($_SESSION['loggedIn']['rol'] == "admin" OR $_SESSION['loggedIn']['rol'] == "superadmin"){
                    return TRUE;
                }else{
                    header('location: index.php?sec=login');
                }

            } else {
                return TRUE;
            }
        } else {
            header('location: index.php?sec=login');
        }
    }
}

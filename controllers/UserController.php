<?php
class UserController extends ControladorBase
{
    public function __construct() {
        parent::__construct();
    }

    public function logout()
    {
        if(!$this->helper()->isUserLogged())
            return $this->redirect("Site", "index");

        session_unset();
        session_destroy();
        session_start();
        $_SESSION["login"] = false;

        $this->view(
            "user/logout.php"
        );
    }

    public function login()
    {
        $formErrors = [];

        $email = "";
        $user_password = "";

        if($this->helper()->isUserLogged())
            return $this->redirect("Site", "index");

        if (isset($_POST["email"]) && isset($_POST["password"])) {

            $email = htmlspecialchars(trim(strip_tags($_POST["email"])));
            $user_password = htmlspecialchars(trim(strip_tags($_POST["password"])));

            if (!empty($email) && !empty($user_password)) {
                //se crear el dao
                $user = DaoUsuario::getInstance()->searchUsuarioByEmailPass($email,$user_password);
                if ($user == null){
                    $formErrors[] = "Usuario o contraseña incorrectos!";
                }
                else {
                    $_SESSION["login"] = true;
                    $_SESSION["user_id"] =  $user['id'];

                    $this->redirect("Site", "index");
                }
            }
            else
            {
                $formErrors[] = 'Problemas formulario';
            }
        }

        $this->view(
            "user/login.php",
            [
                'formErrors' => $formErrors,
                'email' => $email,
                'user_password' => $user_password,
            ]
        );
    }

    public function register()
    {
        $formErrors = [];

        $name = "";
        $password = "";
        $repassword = "";
        $email = "";
        $telefono = "";
        $apellido = "";
        $descripcion =  "";

        if($this->helper()->isUserLogged())
            return $this->redirect("Site", "index");

        if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["repassword"]) && 
            isset($_POST["email"]) && isset($_POST["apellido"])) 
        {
            $name = htmlspecialchars(trim(strip_tags($_POST["name"])));
            $password = htmlspecialchars(trim(strip_tags($_POST["password"])));
            $repassword = htmlspecialchars(trim(strip_tags($_POST["repassword"])));
            $email = htmlspecialchars(trim(strip_tags($_POST["email"])));
            $apellido = htmlspecialchars(trim(strip_tags($_POST["apellido"])));

            if (!empty($name) && !empty($password) && !empty($email) && !empty($apellido) ) {
                if($repassword == $password)
                {
                    $user = DaoUsuario::getInstance()->getBy("email", $email);

                    if (!$user) {
                        $id = DaoUsuario::getInstance()->insertUsuario($name, $apellido, $email, $password);

                        if($id){
                            $_SESSION["login"] = true;
                            $_SESSION["user_id"] = $id;
                            $this->redirect("Site", "index");
                        }
                        else {
                            $formErrors[] = "Registro incorrecto!";
                        }
                    }
                    else { 
                        $formErrors[] = "El Usuario ya Existe, Intentelo otra vez!";
                    }
                }
                else 
                    $formErrors[] = "Las contraseñas no coinciden";

            }
        }

        $this->view(
            "user/register.php",
            [
                'formErrors' => $formErrors,
                'name' => $name,
                'user_password' => $user_password,
                'repassword' => $repassword,
                'email' => $email,
                'apellido' => $apellido,
            ]
        );
    }
}
?>

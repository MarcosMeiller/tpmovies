<?php namespace Controllers;

Use Models\User as User;
Use Dao\UserDAO as UserDAO;
Use Dao\RolDAO as Rol;

class LoginController
{
    private $dao;
    private $rol;

    function __construct(){
        $this->dao = new UserDAO(); 
        $this->rol = new Rol();
    }


    public function LoginUser($email,$password){

        $email = $this->test_input($email);
        $password = $this->test_input($password);

        if($email && $password){
            $newUser = $this->dao->search($email);

            if($newUser !== null){
                if($newUser->getPassword() == $password){   

                    $_SESSION['loggedUser'] = $newUser;
                    
                    $user = $_SESSION["loggedUser"];
                    $_SESSION["isAdmin"] = $user->getId_Type();
                    $id_type = $user->getId_Type();
                    $Rol = $this->rol->search($id_type);
                   if($Rol !== null){
                        $_SESSION['rol'] = $Rol;
                        $type = $Rol->getType();
                        if($type != null){
                            $_SESSION["isAdmin"] = $type;
                        }
                    }
                    header("Location: /tpmovies/");
                }
                else{
                    $this->Index("Usuario o contraseña incorrecta.", 2); 
                }
            }else{
                $this->Index("Error al intentar iniciar sesion", 2);
            }
        }else{
            $this->Index("No se permiten campos vacios.", 2);
        }
        
    }

    public function Index($message = "", $bg=1)
    {
        if(empty($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."login.php");
        }else{
            header("Location: /tpmovies/");
        }
    }       
    
    public function Logout(){
        unset($_SESSION['loggedUser']);
        unset($_SESSION["isAdmin"]);
        unset($_SESSION['id']);
        session_destroy();
        header("Location: /tpmovies/");
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}
}





?>
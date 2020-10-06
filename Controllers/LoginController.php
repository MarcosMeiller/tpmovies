<?php namespace Controllers;

Use Models\User as User;
Use Dao\UserDAO as UserDAO;

class LoginController
{
    private $dao;

    function __construct(){
        $this->dao = new UserDAO(); 
    }

    public function LoginUser($email,$password){
        $newUser = $this->dao->search($email);

        if($newUser !== null ){
            if($newUser->getPassword() == $password){   

                $_SESSION['loggedUser'] = $newUser;
                header("Location: /tpmovies/");

                }
            else{
                $this->ViewLogin("Usuario o contraseña incorrecta."); 
            }
        }else{
            $this->ViewLogin("No existe un usuario con ese email.");
        }
    }

    public function ViewLogin($message = "")
    {
        if(empty($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."login.php");
        }else{
            header("Location: /tpmovies/");
        }
    }       
    
    public function Logout(){
        unset($_SESSION['loggedUser']);
        session_destroy();
        header("Location: /tpmovies/");
    }
}





?>
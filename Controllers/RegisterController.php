<?php namespace Controllers;

Use Models\User as User;
Use Dao\UserDAO as UserDAO;

class RegisterController
{
    private $dao;

    function __construct(){
        $this->dao = new UserDAO(); 
    }
  

    public function RegisterUser($userName,$name,$lastname,$email,$password,$passwordRepeat){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($password !== $passwordRepeat){
                $this->ViewRegister("Las contraseñas no son iguales.");
            }
            $user = $this->dao->search($email);
            if($user !== null){
                $this->ViewRegister("El email ya se encuentra registrado.");
            }
            
            try{
                $newUser = new User($userName,$name,$lastname,$email,$password);
                //$newUser->setType(0);
                $this->dao->add($newUser);
                $user = $this->dao->search($email);
                if($user !== null){
                    $_SESSION['loggedUser'] = $newUser;
                    header("Location: /tpmovies/");
                }
                $this->ViewRegister("Error al intentar registrar cuenta.");
            }catch(Exception $e){
                $this->ViewRegister("Error al intentar crear cuenta.");
            }
        }
    }


    public function ViewRegister($message = "")
    {
        if(empty($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."register.php");
        }else{
            header("Location: /tpmovies/");
        }      
    }        
}


?>
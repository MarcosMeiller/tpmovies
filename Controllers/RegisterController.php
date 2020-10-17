<?php namespace Controllers;

Use Models\User as User;
Use Dao\UserDAO as UserDAO;

class RegisterController
{
    private $dao;

    function __construct(){
        $this->dao = new UserDAO(); 
    }
  

    public function RegisterUser($id,$userName,$name,$lastname,$email,$password,$passwordRepeat){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($password !== $passwordRepeat){
                $this->Index("Las contraseñas no son iguales.",2);
            }else{
                $user = $this->dao->search($email);
                if($user !== null){
                    $this->Index("El email ya se encuentra registrado.",2);
                }else{
                    try{
                    $newUser = new User($id,$userName,$name,$lastname,$email,$password);
                    $this->dao->add($newUser);
                    $user = $this->dao->search($email);
                    if($user !== null){
                        $_SESSION['loggedUser'] = $newUser;
                        header("Location: /tpmovies/");
                    }
                    $this->Index("Error al intentar registrar cuenta.",2);
                    }catch(Exception $e){
                        $this->Index("Error al intentar crear cuenta.",2);
                    }
                }
                
                
            }
            
        }
    }


    public function Index($message = "", $bg=1)
    {
        if(empty($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."register.php");
        }else{
            header("Location: /tpmovies/");
        }      
    }        
}


?>
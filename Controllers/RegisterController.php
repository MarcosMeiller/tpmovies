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

            $userName = $this->test_input($userName);
            $name = $this->test_input($name);
            $lastname = $this->test_input($lastname);
            $email = $this->test_input($email);
            $password = $this->test_input($password);
            $passwordRepeat = $this->test_input($passwordRepeat);
          
            if($userName && $name && $email && $password && $passwordRepeat && $lastname){

                if($password !== $passwordRepeat){
                    $this->Index("Las contraseñas no son iguales.",2);
                }else{
                    //$user = $this->dao->search($email); VEEEER
                    $user = NULL;
                    if($user !== null){
                        $this->Index("El email ya se encuentra registrado.",2);
                    }else{
                        try{
                        $newUser = new User($userName,$name,$lastname,$email,$password);
                        $user = null;
                        $user = $this->dao->add($newUser);
                        //$user = $this->dao->search($email); VEEER
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
            }else{
                $this->Index("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo",2);
            }
        }
    
    }          
    
    
    public function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
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
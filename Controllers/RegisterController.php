<?php namespace Controllers;

Use Models\User as User;
Use Dao\UserDAO as UserDAO;
Use FFI\Exception;
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
                    $User = $this->dao->search($email); 
                    //$user = NULL;
                    if($User !== null){
                        $this->Index("El email ya se encuentra registrado.",2);
                    }else{
                        try{
                        $newUser = new User($userName,$name,$lastname,$email,$password);
                        $user = null;
                        $user = $this->dao->add($newUser);
                        if($user == 1){
                            $_SESSION['loggedUser'] = $newUser;
                            header("Location: ".FRONT_ROOT);
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
        if(strlen($data) < 3){
            $data = null;
        }
        return $data;
    }


    public function Index($message = "", $bg=1)
    {
        if(empty($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."register.php");
        }else{
            header("Location: ".FRONT_ROOT);
        }      
    }        
}


?>
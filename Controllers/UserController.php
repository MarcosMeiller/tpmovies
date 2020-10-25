<?php namespace Controllers;

Use Models\User as User;
Use Dao\userDAO as userDAO;

class UserController
{
    private $dao;

    function __construct(){
        $this->dao = new userDAO(); 
    }

   /* public function updateUser($id,$userName,$name,$lastname,$email,$password){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $this->dao->search($email);
            if($user == null){
                $this->ViewUser("El usuario no existe.");
            }
            
            try{
                $newUser = new User($id,$userName,$name,$lastname,$email,$password);
                $this->dao->update($newUser);
                $this->ViewUser("Modificado con exito");
            }catch(Exception $e){
                $this->ViewUser("Error al modificar Usuario.");
            }
        }
    }
    */
    public function deleteUsers($email){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $this->dao->search($email);
            if($user == null){
                $this->ViewUser("El usuario no existe");
            }
            
            try{
                $this->dao->delete($email);
                $this->ViewUser("eliminado con exito");
            }catch(Exception $e){
                $this->ViewUser("Error al eliminar Usuario.");
            }
        }
    }

    public function ViewUser($message = "")
    {
        $cinemasList = $this->dao->getAll();
        require_once(VIEWS_PATH_ADMIN."/usermb.php");
    }        
}


?>
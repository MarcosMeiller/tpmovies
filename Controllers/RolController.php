<?php namespace Controllers;

Use Models\Rol as Rol ;
Use Dao\RolDAO as RolDAO;

class RolController
{
    private $dao;

    function __construct(){
        $this->dao = new RolDAO(); 
    }

    public function addRol($id,$Type){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rol = $this->dao->search($id);
            if($rol !== null){
                $this->ViewRol("el Rol ya existe.");
            }
            
            try{
                $newRol = new Rol($id,$Type);
                $this->dao->add($newRol);
                $this->ViewRol("Agregado con exito");
            }catch(Exception $e){
                $this->ViewRol("Error al Registrar Rol.");
            }
        }
    }

    public function searchRol($id){
        $rol = $this->dao->search($id);
            
        if($rol != null){
            return $rol->getType();
        }
        else{
            return null; 	
        }
    }


    public function ViewRol($message = "")
    {
        $rolList = $this->dao->getAll();
        require_once(VIEWS_PATH_ADMIN."/rolMenu.php");
    }        
}


?>
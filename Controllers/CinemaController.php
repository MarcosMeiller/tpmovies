<?php namespace Controllers;

Use Models\Cinema as Cinema;
Use Dao\CinemaDAO as cinemaDAO;

class CinemaController
{
    private $dao;

    function __construct(){
        $this->dao = new CinemaDAO(); 
    }
  
    // agrega cine verificando previamente si existe
    public function addCinema($id,$name,$capacity,$address,$priceUnit){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            $address = $this->test_input($address);
            if($name && $address){ 
            $cinema = $this->dao->search($id);
            if($cinema !== null){
                $this->Cinemas("El Cine ya existe.","alert");
            }
            
            try{
                $newCinema = new cinema($id,$name,$capacity,$address,$priceUnit);
                $this->dao->add($newCinema);
                $this->Cinemas("Agregado con exito","success");
            }catch(Exception $e){
                $this->Cinemas("Error al Registrar cine.","danger");
            }
        }
        else{
            $this->Cinemas("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }  
    }
    }

    // actualiza cine verificando si existe previamente
    public function updateCinema($id,$name,$capacity,$address,$priceUnit){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            $address = $this->test_input($address);
            if($name && $address){
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->Cinemas("El Cine no existe.");
            }
            
            try{
                $newCinema = new cinema($id,$name,$capacity,$address,$priceUnit);
                $this->dao->update($newCinema);
                $this->Cinemas("Modificado con exito","success");

            }catch(Exception $e){
                $this->Cinemas("Error al modificar cine.","danger");
            }
        }
        else{
            $this->Cinemas("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }
    }

    }

    // elimina cine por id
    public function deleteCinema($id){
            $cinema = $this->dao->search($id);
            if($cinema === null){
                $this->Cinemas("El Cine no existe.","alert");
            }  
            try{
                $this->dao->delete($id);
                $this->Cinemas("Eliminado con exito","success");
            }catch(Exception $e){
           
                $this->Cinemas("Error al eliminar cine.","danger");
            }
    }

    //comprueba que los datos cargados sean validos.
    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}



    // retorna todos los cines y carga la pantalla de amb cines
    public function Cinemas($message = "",$type= ""){
        if(isset($_SESSION['loggedUser'])){
            $cinemasList = $this->dao->getAll();
            if($message === '' && $type === ''){
                //unset($_SESSION['msjCinemas']);
                //unset($_SESSION["bgMsgCinemas"]);
                require_once(VIEWS_PATH_ADMIN."/cinemaslamb.php");
            }else{
                $_SESSION['msjCinemas'] = $message;
                $_SESSION["bgMsgCinemas"] = $type;
                header("Location: /tpmovies/Cinema/Cinemas/");
            }
        }else{
            header("Location: /tpmovies/");
        }
    }        
}


?>
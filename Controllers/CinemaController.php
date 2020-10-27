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
    public function addCinema($name,$address){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = $this->test_input($name);
            $address = $this->test_input($address);
            
            if($name && $address){
                $cinema = NULL;
                //$cinema = $this->dao->search($id); // VEEEER
                if($cinema !== null){
                    $this->Cinemas("El Cine ya existe.","alert");
                }
                
                try{
                    $newCinema = new cinema($name,$address);
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
    public function updateCinema($id,$name,$address){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            $address = $this->test_input($address);
            if($name && $address){

            try{
                $newCinema = new cinema($name,$address);
                $newCinema->setId($id);
                $countUpdate = $this->dao->update($newCinema);
                if($countUpdate > 0){
                    $this->Cinemas("Modificado con exito","success");
                }else{
                    $this->Cinemas("Error al intentar modificar","alert");
                }
                
                

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

            try{
                $countDelete = $this->dao->delete($id);
                if($countDelete > 0){
                    $this->Cinemas("Eliminado con exito","success");
                }else{
                    $this->Cinemas("Error al intentar eliminar","alert");
                }
                
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
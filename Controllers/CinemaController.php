<?php namespace Controllers;

Use Models\Cinema as Cinema;
Use Dao\CinemaDAO as cinemaDAO;

class CinemaController
{
    private $dao;

    function __construct(){
        $this->dao = new CinemaDAO(); 
    }
  

    
    public function addCinema($id,$name,$capacity,$address,$priceUnit){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    }

    public function updateCinema($id,$name,$capacity,$address,$priceUnit){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->Cinemas("El Cine no existe.");
            }
            
            try{
                $newCinema = new cinema($id,$name,$capacity,$address,$priceUnit);
                $this->dao->update($newCinema);
                $this->Cinemas("Modificado con exito","success");

            }catch(Exception $e){
                $this->Cinemas("Error al modificar cine.");
            }
        }
    }

    public function deleteCinema($id){
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
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
        //}
    }

    public function Cinemas($message = "",$type= "")
    {
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
    }        
}


?>
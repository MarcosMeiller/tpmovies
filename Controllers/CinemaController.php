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
                $this->ViewCinemas("El Cine ya existe.");
            }
            
            try{
                $newCinema = new cinema($id,$name,$capacity,$address,$priceUnit);
                $this->dao->add($newCinema);
                //header("Location: /tpmovies/");
                $this->ViewCinemas("Agregado con exito");
            }catch(Exception $e){
                $this->ViewCinemas("Error al Registrar cine.");
            }
        }
    }

    public function updateCinema($id,$name,$capacity,$address,$priceUnit){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->ViewCinemas("El Cine no existe.");
            }
            
            try{
                $newCinema = new cinema($id,$name,$capacity,$address,$priceUnit);
                $this->dao->update($newCinema);
                $this->ViewCinemas("Modificado con exito");
            }catch(Exception $e){
                $this->ViewCinemas("Error al modificar cine.");
            }
        }
    }

    public function deleteCinema($id){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->ViewCinemas("El Cine no existe.");
            }
            
            try{
                $this->dao->delete($id);
                $this->ViewCinemas("eliminado con exito");
            }catch(Exception $e){
                $this->ViewCinemas("Error al eliminar cine.");
            }
        }
    }

    public function ViewCinemas($message = "")
    {
        $cinemasList = $this->dao->getAll();
        require_once(VIEWS_PATH_ADMIN."/cinemaslamb.php");
    }        
}


?>
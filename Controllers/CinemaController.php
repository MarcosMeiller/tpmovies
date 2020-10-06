<?php namespace Controllers;

Use Models\Cinema as Cinema;
Use Dao\CinemaDAO as cinemaDAO;

class CinemaController
{
    private $dao;

    function __construct(){
        $this->dao = new CinemaDAO(); 
    }
  

    public function addCinema($capacity,$name,$location,$id){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema !== null){
                $this->ViewRegister("El id ya existe.");
            }
            
            try{
                $newCinema = new cinema($capacity,$name,$location,$id);
                $this->dao->add($newCinema);
                header("Location: /tpmovies/");
            }catch(Exception $e){
                $this->ViewRegister("Error al Registrar cine.");
            }
        }
    }


    public function ViewRegister($message = "")
    {
        require_once(VIEWS_PATH."Cinema.php");
    }        
}


?>
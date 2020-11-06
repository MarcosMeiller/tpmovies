<?php 

namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
Use Models\Cinema as Cinema;
Use Dao\CinemaDAO as cinemaDAO;
Use Dao\GenreDAO as GenreDAO;
use Exception;

class ShowtimesController{
    private $dao;
    private $daoR;
    private $daoM; 
    private $daoG;

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO();
        $this->daoC = new cinemaDAO(); 
        $this->daoG = new GenreDAO;

    }

    public function dateFiltrer($date){
        $functionsList = $this->dao->FilterList($date);

    }

    public function Listing($message = "",$type= "",$id = 0){
        
        
        if(isset($_SESSION['loggedUser'])){          
                $functionsList = $this->dao->getAll();
                $roomList = $this->daoR->getAll();
                $adminmovies = $this->daoM->getAll($id);
                $cinemasList = $this->daoC->getAll();
                //$genresList = $this->daoG->getAll();
                require_once(VIEWS_PATH."/movieslisting.php");
                //header("Location: /tpmovies/Showtimes/Listing");
        
        }
        else{
            header("Location: /tpmovies/");
        }
    }

}



?>
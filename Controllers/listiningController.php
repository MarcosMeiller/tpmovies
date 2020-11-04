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
use Exception;

class FunctionController{
    private $dao;
    private $daoR;
    private $daoM; 

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO();
        $this->daoC = new cinemaDAO(); 
    }


    public function Listinings($message = "",$type= "",$id = 0){
        
        
        if(isset($_SESSION['loggedUser'])){          
                $this->dao->getAll();
                $this->daoR->getAll();
                $this->daoM->getAll($id);
                $this->daoC->getAll();
                //require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                header("Location: /tpmovies/Function/Functions");
        
        }
        else{
            header("Location: /tpmovies/");
        }
    }

}



?>
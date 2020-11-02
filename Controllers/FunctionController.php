<?php 

namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;

class FunctionController{
    private $dao;
    private $daoR;
    private $daoM; 

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO(); 
    }

    public function addFunction($id_Room,$id_movie,$date,$hour){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
             $date = $this->test_input($date);
             $hour = $this->test_input($hour);
             $id_movie = $this->daoM->search($id_movie);
             $id_Room = $this->daoR->search($id_Room);
            if($date && $hour && $id_movie && $id_Room){
                $actualDate = date("Y-m-d");
                if($date > $actualDate){ 
                    $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                    $this->dao->add($function);
                }
                else{
                    $this->Functions("la fecha actual no esta disponible.");
                }
            }

        }

    }

    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}


    public function Functions($id = 0){
   
        $roomList = $this->daoR->getAll();
        $adminmovies = $this->daoM->getMoviexAdmin($id);
        $functionList = $this->dao->getAll();
        //$functionList = []; la use porque no tenia creada la tabla
        require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
    }

}








?>
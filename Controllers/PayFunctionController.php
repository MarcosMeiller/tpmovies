<?php namespace Controllers;


//Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
//Use Models\Movie as Movie;
//Use Dao\MovieDAO as movieDAO;
//use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
//Use Dao\CinemaDAO as cinemaDAO;
//use Models\Cinema as Cinema;
use Dao\TicketDAO as ticketDAO;

class PayFunctionController
{
    private $daoF;
    private $daoR;
    private $daoT;
  

    public function __construct(){
        $this->daoF = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoT = new ticketDAO();

    }
    
    public function Index($message = "", $type="",$id = 0)
    {
        if(!isset($_SESSION["loggedUser"])){
            $url = $_SESSION['url'];
            $_SESSION['bg'] = 1;
            require_once(VIEWS_PATH."login.php");
            //header("Location:".FRONT_ROOT."Login");
        }else{
            $this->Checkout();            
        }    
    }      
    
    public function Checkout($idFunction){
        $function = $this->daoF->searchFunction($idFunction);

        $ticketsList = $this->daoT->getAll();
        $roomList = $this->daoR->getAll();

        $user = $_SESSION['loggedUser'];
        $iduser = $user->getId();

        //$cardList = $this->daoCard->getCardsUser($iduser);

        require_once(VIEWS_PATH."getTicket.php");
    }
}


?>
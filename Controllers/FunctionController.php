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
             //$date = $this->test_input($date);
             //$hour = $this->test_input($hour);
                $actualDate = date("Y-m-d");
                if($date > $actualDate){ 
                    $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                    $valid = $this->dao->add($function);
                    if($valid == "exist"){
                        echo "ese dia ya se esta reproduciendo esa pelicula en otro cine/sala";
                    }
                    else{
                        require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                    }
                }
                else{
                    echo "error";
                }
            }

        }

   /* public function deleteFunction ($id){
        $this->dao->delete($id);

    }

    public function updateFunction ($id,$id_Room,$id_movie,$date,$hour){      
                $newCinema = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                $newCinema->setId($id);
                $countUpdate = $this->dao->update($newCinema);
              
    }
*/
    

    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if(strlen($data) < 3){
            $data = null;
        }
        return $data;
}


    public function Functions($id = 0){
        
        
        if(isset($_SESSION['loggedUser'])){          
            unset($_SESSION['id']);
        $movieList = array();
        $user = $_SESSION['loggedUser'];
        $id = $user->getId();
        $roomList = $this->daoR->getAll();
        $adminmovies = $this->daoM->getMoviexAdmin($id);
        $functionList = $this->dao->getAll();
        foreach($adminmovies as $admin){
            $movieList[] = $this->daoM->searchMovieIdApi($admin['id_movie']);
        }
        $adminmovies = $movieList;
       
        
     
        require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
        }
        else{
            header("Location: /tpmovies/");
        }
    }

}








?>
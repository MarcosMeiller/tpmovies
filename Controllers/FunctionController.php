<?php 

namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
use Exception;

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
                
                $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                $valid = $this->dao->add($function);
                if($valid == "exist"){
                    $this->Functions('Ese dia ya se esta reproduciendo esa pelicula en otro cine/sala','alert');
                }
                else{
                    $this->Functions('La funcion se agrego exitosamente','success');
                }

            }

        }

    public function deleteFunction($id){
        try{
            $this->dao->delete($id);
            $this->Functions("Eliminado con exito","success");
        }
        catch(Exception $e){
            $this->Functions("Error al eliminar Sala","danger");
        }
        

    }

    public function updateFunction ($id,$id_Room,$id_movie,$date,$hour){   
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            try{
                $newCinema = new FunctionCinema($id_Room,$id_movie,$date,$hour);

                $newCinema->setId($id);
                $countUpdate = $this->dao->update($newCinema);

                $this->Functions("Funcion modificada exitosamente","success");
            }
            catch(Exception $e){
                $this->Functions("Error al modificar Funcion.","danger");
            }
        }  
        else{
            $this->Functions("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        } 
                
              
    }

    

    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if(strlen($data) < 3){
            $data = null;
        }
        return $data;
}


    public function Functions($message = "",$type= "",$id = 0){
        
        
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
       
            if($message === '' && $type === ''){
                unset($_SESSION['msjFunction']);
                unset($_SESSION["bgMsgFunction"]);
                require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                
            }else{
                $_SESSION['msjFunction'] = $message;
                $_SESSION["bgMsgFunction"] = $type;

                //require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                header("Location: /tpmovies/Function/Functions");
            }
        
        }
        else{
            header("Location: /tpmovies/");
        }
    }

}



?>
<?php 

namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
Use Dao\CinemaDAO as cinemaDAO;
use Models\Cinema as Cinema;
use Exception;
use DateTime;

class FunctionController{
    private $dao;
    private $daoR;
    private $daoM; 
    private $daoC;

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO(); 
        $this->daoC = new cinemaDAO();
    }

    public function addFunction($id_Room,$id_movie,$date,$hour){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
             //$date = $this->test_input($date);
             //$hour = $this->test_input($hour);
                
                $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                $movie = $this->daoM->searchIdBdd($id_movie);
                $functionList = $this->dao->getAll();
                $isValid = true;
                
                    foreach($functionList as $lfunction){
                        $isValid = $this->validFunction($function,$lfunction,$movie);
                    }
                 
                
                if($isValid == true){ 
                    $isValid = $this->dao->add($function);
                }
                else{
                    $this->Functions('La hora es invalida, se superpone con otra funcion.','alert');
                }
                if($isValid == "exist"){
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


    public function Functions($message = '',$type= '',$id = 0){
        
        if(isset($_SESSION['loggedUser'])){          
            unset($_SESSION['id']);
            $movieList = array();
            $user = $_SESSION['loggedUser'];
            $id = $user->getId();
            $roomList = $this->daoR->getAll();
            $adminmovies = $this->daoM->getMoviexAdmin($id);
            $functionList = $this->dao->getAll();
            $cinemaList = $this->daoC->getAll();
            foreach($adminmovies as $admin){
                $movieList[] = $this->daoM->searchMovieIdApi($admin['id_movie']);
            }
            $adminmovies = $movieList;
       
            if($message == '' && $type == ''){
                unset($_SESSION['msjFunction']);
                unset($_SESSION["bgMsgFunction"]);
                
                require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                
            }else{
                $_SESSION['msjFunction'] = $message;
                $_SESSION["bgMsgFunction"] = $type;
                echo "no";

                //require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                header("Location: /tpmovies/Function/Functions");
            }
        
        }
        else{
            header("Location: ".FRONT_ROOT);
        }
    }
    public function validFunction(FunctionCinema $function,FunctionCinema $newFunction, Movie $movie){
        $isValid = true;
        $fechaVieja = new DateTime($function->getDate());//serian las fechas actuales
        $fechaNueva = new DateTime($newFunction->getDate());// irian las fechas nueva
        $horaVieja = new DateTime($function->getHour());//irian las horas //deberia compararlo asi y sumandole el get duration.
        $horaNueva = new DateTime($newFunction->getHour());// irian la hora nueva
    
        //$convertHour = new DateTime($this->hoursandmins($movie->getDuration()));
    
        //$horaViejaFinal = $horaVieja + $convertHour;
        //$horaNuevaFinal = $horaNueva + $convertHour;
        //diferencia entre 2 dias es 1 y una de las peliculas termina despues
        
        if($fechaVieja == $fechaNueva && $function->getId_Movie() == $newFunction->getId_Movie()){
            
            $diff = $horaVieja->diff($horaNueva);   // 14:00 15:00.
            $resultado = ($diff->days * 24 * 60) +
            ($diff->h * 60) + $diff->i;
            //18:00 16:00 pelicula es 60 min. diferencia es igual a 60 min < a 60 + 15  
            if($resultado <= $movie->getDuration() + 15){
                $isValid = false;
            }
          
             
        }
     
        return $isValid;
    
    
    }

    public function DetailsFunction($id){

        $functionsList = $this->dao->getAll();
        $roomList = $this->daoR->getAll();
        $movie = $this->daoM->searchIdBdd($id);
        $cinemasList = $this->daoC->getAll();
        require_once(VIEWS_PATH."detailsFunction.php");
    }

}



?>
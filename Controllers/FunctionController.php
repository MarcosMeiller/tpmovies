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
use Dao\TicketDAO as ticketDAO;
use Exception;
use DateTime;

class FunctionController{
    private $dao;
    private $daoR;
    private $daoM; 
    private $daoC;
    private $daoT;

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO(); 
        $this->daoC = new cinemaDAO();
        $this->daoT = new ticketDAO();

    }

    public function addFunction($id_Room,$id_movie,$date,$hour){
       
             //$date = $this->test_input($date);
             //$hour = $this->test_input($hour);
             if(isset($_SESSION["isAdmin"])){
                if($_SESSION['isAdmin'] == 'admin'){
                 if($id_Room && $id_movie && $date && $hour){ 
                $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                $movie = $this->daoM->searchIdBdd($id_movie);
                $functionList = $this->dao->getAll();
                $isValid = true;
                
                    foreach($functionList as $lfunction){
                        if($isValid == true){
                        $isValid = $this->validFunction($function,$lfunction,$movie);
                        }
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
                else if ($isValid !== "exist" && $isValid !== false){
                    $this->Functions('La funcion se agrego exitosamente','success');
                }
            }
            else{
                $this->Functions('los campos estan incompletos.','alert');
            }
            }
        } 
            

    }

    
    public function deleteFunction($id){
        if(isset($_SESSION["isAdmin"])){
            if($_SESSION['isAdmin'] == 'admin'){
        try{
            
            $this->dao->delete($id);
            $this->Functions("Eliminado con exito","success");
        }
        catch(Exception $e){
            $this->Functions("Error al eliminar Sala","danger");
        }
        } 
    }

    }

    public function updateFunction ($id,$id_Room,$id_movie,$date,$hour){   
        if(isset($_SESSION["isAdmin"])){
            if($_SESSION['isAdmin'] == 'admin'){
            try{
                $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);

                $function->setId($id);
                $movie = $this->daoM->searchIdBdd($id_movie);
                $functionList = $this->dao->getAll();
                $isValid = true;
                
                foreach($functionList as $lfunction){
                    if($isValid == true){
                        $isValid = $this->validFunction($function,$lfunction,$movie);
                     } 
                    }
                if($isValid == true){ 
                $countUpdate = $this->dao->update($function);
                $this->Functions("Funcion modificada exitosamente","success");
                }
                else{
                    $this->Functions("la hora se interpone con otro horario, ingrese otro horario","alert");
                }
            }
            catch(Exception $e){
                $this->Functions("Error al modificar Funcion.","danger");
            }
        }
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
            $cinemaList = $this->daoC->getAll();
            foreach($adminmovies as $admin){
                $movieList[] = $this->daoM->searchMovieIdApi($admin['id_movie']);
            }
            $adminmovies = $movieList;
       
            if($message == '' && $type == ''){
                //unset($_SESSION['msjFunction']);
                //unset($_SESSION["bgMsgFunction"]);
                
                require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                
            }else{
                $_SESSION['msjFunction'] = $message;
                $_SESSION["bgMsgFunction"] = $type;
          

                //require_once(VIEWS_PATH_ADMIN."/functionslamb.php");
                header("Location: ".FRONT_ROOT."Function/Functions");
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
       
        $aux = date('H:i');

        $horaactual = new DateTime($aux);
        $aux = date('Y-m-d');
        $hoy = new DateTime($aux);
        $diff = $horaNueva->diff($horaactual); 
        $resultado = ($diff->days * 24 * 60) +
        ($diff->h * 60) + $diff->i;


 
        if($fechaVieja <= $hoy && $resultado <= 300 && $horaactual < $horaVieja){
            $isValid = false;
        }
        else{ 
            
        $diff = $fechaNueva->diff($fechaVieja);
        $diferenciaDias =  $diff->days; 
        
        if($diferenciaDias <= 1 && $function->getId_Movie() == $newFunction->getId_Movie()){
            $runtime = 0;
            $diff = $horaVieja->diff($horaNueva);   // 14:00 15:00.
            $resultado = ($diff->days * 24 * 60) +
            ($diff->h * 60) + $diff->i;
            //18:00 16:00 pelicula es 60 min. diferencia es igual a 60 min < a 60 + 15
    
            if($resultado <= $movie->getDuration() + 15 && $diferenciaDias == 0){
                $isValid = false;
            }
        
          
            if($resultado >= 1425 - $movie->getDuration() && $diferenciaDias == 1){
                if($fechaVieja < $fechaNueva && $horaVieja < $horaNueva){   //fecha vieja 09/11 < fecha nueva 10/11. y hora vieja 00:05 < hora nueva 22:55.
                  $isValid = true;    // no se deje                               
               }else if($fechaVieja > $fechaNueva && $horaVieja > $horaNueva){
                    $isValid = true; 
               }else{
                $isValid = false;
               }
              
            }
          
             
        }
    }
     
        return $isValid;

    }

  
    public function DetailsFunction($id){

        $functionsList = $this->dao->getAll();
        $ticketsList = $this->daoT->getAll();

        $roomList = $this->daoR->getAll();
        $movie = $this->daoM->searchIdBdd($id);
        $cinemasList = $this->daoC->getAll();
        require_once(VIEWS_PATH."detailsFunction.php");
    }

    public function Balance(){
        $functionsList = $this->dao->getAll();
        $ticketsList = $this->daoT->getAll();
        $roomList = $this->daoR->getAll();
        $cinemaList = $this->daoC->getAll();
        $movieList = $this->daoM->getAll(0);
        $i = 0;
        $quantity = 0;
        $VentasxRoom = [];
        $NovendidasxRoom = [];
        /*foreach($functionsList as $function){ x sala.
            $quantity = $this->daoT->getAllTicketForShow($function->getId());
            $quantity = count($quantity);
                if($quantity > 0){ 
                    $VentasxRoom[$i] = $quantity;
                    $room = $this->daoR->Search($function->getId_Room());
                    $NovendidasxRoom[$i] = $room->getCapacity() - $VentasxRoom[$i];
                    $i ++;
                }   
        }*/
        foreach($cinemaList as $cinema){ //hecho x cine.
            $roomList = $this->daoR->searchRoomsbyIdCinema($cinema->getId());
            foreach($roomList as $room){ 
                foreach($functionsList as $function){
                    if($room->getId() == $function->getId_Room()){ 
                        $quantity = $this->daoT->getAllTicketForShow($function->getId());
                        $quantity = count($quantity);
                        if($quantity > 0){ 
                            if($VentasxRoom[$i]){ 
                                $VentasxRoom[$i] += $quantity;
                            }
                            else{
                                $VentasxRoom[$i] = $quantity;
                            }
                            $room = $this->daoR->Search($function->getId_Room());
                            if($NovendidasxRoom){
                                $NovendidasxRoom[$i] += $room->getCapacity() - $VentasxRoom[$i];
                            }
                            else{
                                $NovendidasxRoom[$i] = $room->getCapacity() - $VentasxRoom[$i];
                            }
                            
                        }
                    }   
                }
            }
            
            $i ++;
        }
        /*foreach($movieList as $movie){ 
        foreach($functionsList as $function){
            if($movie->getId() == $function->getId_Movie()){
                foreach($roomList as $room){
                    $quantity = $this->daoT->getAllTicketForShow($function->getId());
                    $quantity = count($quantity);
                        if($quantity > 0 && $function->getId_Room() == $room->getId()){ 
                            $VentasxRoom[$i] = $quantity;
                            $room = $this->daoR->Search($function->getId_Room());
                            $NovendidasxRoom[$i] = $room->getCapacity() - $VentasxRoom[$i];
                            $i ++;
                        }   


                 }
            }

        }
    }*/

        var_dump($NovendidasxRoom);
        var_dump($VentasxRoom);

        require_once(VIEWS_PATH_ADMIN."/balance.php");
    }

}



?>
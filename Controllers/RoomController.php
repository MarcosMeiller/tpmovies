<?php namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Dao\CinemaDAO as CinemaDAO;


class RoomController
{
    private $dao;
    private $daoC;

    function __construct(){
        $this->dao = new RoomDao(); 
        $this->daoC = new CinemaDAO();

    }
  
    // agrega cine verificando previamente si existe
    public function addRoom($id_Cinema,$name,$capacity,$price){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            if($name){ 
           //$room = $this->dao->search($name);
            $room = null;
            if($room !== null){
                $this->Rooms("La Sala ya existe.","alert");
            }
            
            try{
                $newRoom = new Room($capacity,$id_Cinema,$name,$price);
                $this->dao->add($newRoom);
                $this->Rooms("Agregado con exito","success");
            }catch(Exception $e){
                $this->Rooms("Error al Registrar Sala.","danger");
            }
        }
        else{
            $this->Rooms("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }  
    }
    }

    // actualiza cine verificando si existe previamente
    public function updateRoom($Capacity,$id_Cinema,$name,$price){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            if($name){
            $room = $this->dao->search($data);
            if($room == null){
                $this->Rooms("la Sala no existe.");
            }
            
            try{
                $newRoom = new Room($Capacity,$id_Cinema,$name,$price);
                $this->dao->add($newRoom);
                $this->Rooms("Modificado con exito","success");

            }catch(Exception $e){
                $this->Rooms("Error al modificar Sala.","danger");
            }
        }
        else{
            $this->Rooms("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }
    }

    }

    // elimina cine por id
    public function deleteRoom($data){
            $room = $this->dao->search($data);
            $room = 0;
            if($room === null){
                $this->Rooms("La sala no existe.","alert");
            }  
            try{
                $this->dao->delete($data);
                $this->Rooms("Eliminado con exito","success");
            }catch(Exception $e){
           
                $this->Rooms("Error al eliminar Sala.","danger");
            }
    }

    //comprueba que los datos cargados sean validos.
    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}
    
        public function RoomsCinema($id = 0){
        if($id !== 0){
            $this->Rooms("","",$id);  
        }else{
            $this->Rooms();
        }
           
    }


    // retorna todos las salas y carga la pantalla de amb room
    public function Rooms($message = "",$type= "",$id=0){
        if(isset($_SESSION['loggedUser'])){
            if($id == 0){
                $roomsList = $this->dao->getAll(); 
            }else{
                $roomsList = $this->dao->getAllByCinema($id);
            }

            $cinemasList = $this->daoC->getAll();  

            if($message === '' && $type === '' && $id === 0){
                unset($_SESSION['idCinema']);
                require_once(VIEWS_PATH_ADMIN."/roomslamb.php");
            }else{
                $_SESSION['idCinema'] = $id;
                $_SESSION['msjRoom'] = $message;
                $_SESSION["bgMsgRoom"] = $type;
                $_SESSION['roomsList'] = $roomsList;
                //header("Location: /tpmovies/Room/Rooms");
                require_once(VIEWS_PATH_ADMIN."/roomslamb.php");
            }
        }else{
            header("Location: /tpmovies/");
        }
    }        
}


?>
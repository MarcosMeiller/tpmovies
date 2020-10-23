<?php namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;

class RoomController
{
    private $dao;

    function __construct(){
        $this->dao = new RoomDao(); 
    }
  
    // agrega cine verificando previamente si existe
    public function addRoom($Capacity,$id_Cinema,$name,$price){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            if($name){ 
            $room = $this->dao->search($data);
            if($cinema !== null){
                $this->Room("La Sala ya existe.","alert");
            }
            
            try{
                $newRoom = new Room($Capacity,$id_Cinema,$name,$price);
                $this->dao->add($newRoom);
                $this->Room("Agregado con exito","success");
            }catch(Exception $e){
                $this->Room("Error al Registrar Sala.","danger");
            }
        }
        else{
            $this->Room("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }  
    }
    }

    // actualiza cine verificando si existe previamente
    public function updateRoom($Capacity,$id_Cinema,$name,$price){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->test_input($name);
            if($name){
            $room = $this->dao->search($data);
            if($cinema == null){
                $this->Room("la Sala no existe.");
            }
            
            try{
                $newRoom = new Room($Capacity,$id_Cinema,$name,$price);
                $this->dao->add($newRoom);
                $this->Room("Modificado con exito","success");

            }catch(Exception $e){
                $this->Room("Error al modificar Sala.","danger");
            }
        }
        else{
            $this->Room("Error al registrar, verifique si no tiene campos vacios o ingresó mal algún campo","danger");
        }
    }

    }

    // elimina cine por id
    public function deleteRoom($data){
            $cinema = $this->dao->search($data);
            if($cinema === null){
                $this->Room("El Cine no existe.","alert");
            }  
            try{
                $this->dao->delete($id);
                $this->Room("Eliminado con exito","success");
            }catch(Exception $e){
           
                $this->Room("Error al eliminar Sala.","danger");
            }
    }

    //comprueba que los datos cargados sean validos.
    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}



    // retorna todos las salas y carga la pantalla de amb room
    public function Room($message = "",$type= ""){
        if(isset($_SESSION['loggedUser'])){
            $roomList = $this->dao->getAll();
            if($message === '' && $type === ''){
                require_once(VIEWS_PATH_ADMIN."/roomlamb.php");
            }else{
                $_SESSION['msjRoom'] = $message;
                $_SESSION["bgMsgRoom"] = $type;
               // header("Location: /tpmovies/Cinema/Cinemas/");
            }
        }else{
            header("Location: /tpmovies/");
        }
    }        
}


?>
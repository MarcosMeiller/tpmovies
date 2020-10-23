<?php 
namespace Dao;

use Dao\IRoom as IRoom ;
use Models\Room as Room;

class roomDAO implements IRoom{
    private $roomList = array();

	
    public function add(Room $newRoom){ ///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
		$this->retrieveData();
		array_push($this->roomList, $newRoom);
		$this->saveData();
	}

	public function getAll(){ ///obtiene todos los datos
		$this->retrieveData();
		return $this->roomList;
	}
    
	public function search($id){ ///busca un elemento dentro de la lista y retorna el objeto encontrado o null

		$newRoom = null;
		$this->retrieveData();
		foreach ($this->roomList as $room) {
			$ID = $room->getId();
			if($ID === $id){
				 $newRoom = $room; 
			}
		}
		return $newRoom;

    }

	public function saveData(){ ///guarda la lista en el json
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();
		$count = 0;
		foreach ($this->roomList as $room) {
			$valueArray['name'] = $room->getName();
			$valueArray['capacity'] = $room->getCapacity();
			$count = $count + 1;
			$valueArray['id'] = $count;
            $valueArray['price'] = $room->getPrice();
            $valueArray['id_Cinema'] = $room->getId_Cinema();

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){ ///llena la lista con los datos dentro del json
		$this->roomList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$room = new Room($valueArray['capacity'],$valueArray['id_Cinema'],$valueArray['name'],$valueArray['price']);
			
			array_push($this->roomList, $room);
		}
    }
    
    public function delete($code){///elimina un dato dentro de la lista
		$this->retrieveData();
		$newList = array();
		foreach ($this->roomList as $room) {
			if($room->getId() != $code){
				array_push($newList, $room);
			}
		}

		$this->roomList = $newList;
		$this->saveData();
	}

	public function update(Room $code){ ///reemplaza un objeto dentro de la lista
		$this->retrieveData();
		$newList = array();
		foreach ($this->roomList as $room) {
			if($room->getId() != $code->getId()){
				array_push($newList, $room);
			}
			else{
				array_push($newList,$code);
			}
		}
		

		$this->roomList = $newList;
		$this->saveData();
	}



    function GetJsonFilePath(){ ///ruta del json

        $initialPath = "Data/room.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}


?>
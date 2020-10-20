<?php 
namespace Dao;

use Dao\ICinema as ICinema ;
use Models\Cinema as Cinema;

class cinemaDAO implements ICinema{
    private $cinemaList = array();

	
    public function add(Cinema $newCinema){ ///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
		$this->retrieveData();
		array_push($this->cinemaList, $newCinema);
		$this->saveData();
	}

	public function getAll(){ ///obtiene todos los datos
		$this->retrieveData();
		return $this->cinemaList;
	}
    
	public function search($id){ ///busca un elemento dentro de la lista y retorna el objeto encontrado o null

		$newCinema = null;
		$this->retrieveData();
		foreach ($this->cinemaList as $cinema) {
			$ID = $cinema->getId();
			if($ID === $id){
				 $newCinema = $cinema; 
			}
		}
		return $newCinema;

	}

	public function saveData(){ ///guarda la lista en el json
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();
		$count = 0;
		foreach ($this->cinemaList as $cinema) {
			$valueArray['name'] = $cinema->getName();
			$valueArray['capacity'] = $cinema->getCapacity();
			$valueArray['address'] = $cinema->getAddress();
			$count = $count + 1;
			$valueArray['id'] = $count;
			$valueArray['priceUnit'] = $cinema->getpriceUnit();

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){ ///llena la lista con los datos dentro del json
		$this->cinemaList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$cinema = new Cinema($valueArray['id'],$valueArray['name'],$valueArray['capacity'],$valueArray['address'],$valueArray['priceUnit']);
			
			array_push($this->cinemaList, $cinema);
		}
    }
    
    public function delete($code){///elimina un dato dentro de la lista
		$this->retrieveData();
		$newList = array();
		foreach ($this->cinemaList as $cinema) {
			if($cinema->getId() != $code){
				array_push($newList, $cinema);
			}
		}

		$this->cinemaList = $newList;
		$this->saveData();
	}

	public function update(Cinema $code){ ///reemplaza un objeto dentro de la lista
		$this->retrieveData();
		$newList = array();
		foreach ($this->cinemaList as $cinema) {
			if($cinema->getId() != $code->getId()){
				array_push($newList, $cinema);
			}
			else{
				array_push($newList,$code);
			}
		}
		

		$this->cinemaList = $newList;
		$this->saveData();
	}



    function GetJsonFilePath(){ ///ruta del json

        $initialPath = "Data/cinemas.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}


?>
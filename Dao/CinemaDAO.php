<?php 
namespace Dao;

use Dao\ICinema as ICinema ;
use model\Cinema as Cinema;

class movieDAO implements IMovie{
    private $cinemaList = array();

	
    public function add(cinema $newCinema){
		$this->retrieveData();
		array_push($this->cinemaList, $newCinema);
		$this->saveData();
	}

	public function getAll(){
		$this->retrieveData();
		return $this->cinemaList;
	}
    
	public function search($id){

		$newCinema = null;
		$this->retrieveData();
		foreach ($this->cinemaList as $cinema) {
			if($cinema->getId() === $id){
				 $newCinema = $cinema; 
			}
		}
		return $newCinema;

	}

	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();

		foreach ($this->cinemaList as $cinema) {
			$valueArray['name'] = $cinema->getName();
			$valueArray['capacity'] = $cinema->getCapacity();
			$valueArray['location'] = $cinema->getLocation();
            $valueArray['id'] = $cinema->getId();

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){
		$this->cinemaList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$cinema = new Cinema($valueArray['capacity'],$valueArray['name'],$valueArray['location'],$valueArray['id']);
			
			array_push($this->cinemaList, $cinema);
		}
    }
    
    public function delete($code){
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

    function GetJsonFilePath(){

        $initialPath = "Data/cinema.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}


?>
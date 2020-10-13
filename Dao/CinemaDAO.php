<?php 
namespace Dao;

use Dao\ICinema as ICinema ;
use Models\Cinema as Cinema;

class cinemaDAO implements ICinema{
    private $cinemaList = array();

	
    public function add(Cinema $newCinema){
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
			$ID = $cinema->getId();
			if($ID === $id){
				 $newCinema = $cinema; 
			}
		}
		return $newCinema;

	}

	public function saveData(){
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

	public function retrieveData(){
		$this->cinemaList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$cinema = new Cinema($valueArray['id'],$valueArray['name'],$valueArray['capacity'],$valueArray['address'],$valueArray['priceUnit']);
			
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

	public function update(Cinema $code){
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



    function GetJsonFilePath(){

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
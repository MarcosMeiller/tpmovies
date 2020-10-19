<?php 
namespace Dao;

use Dao\IRol as IRol ;
use Models\Rol as Rol;

class RolDAO implements IRol{
    private $rolList = array();

	
    public function add(Rol $newRol){
		$this->retrieveData();
		array_push($this->rolList, $newRol);
		$this->saveData();
	}

	public function getAll(){
		$this->retrieveData();
		return $this->rolList;
	}
    
	public function search($id){

		$newRol = null;
		$this->retrieveData();
		foreach ($this->rolList as $rol) {
			$Idrol = $rol->getId();
			if($Idrol == $id){
				 $newRol = $rol; 
			}
		}
		return $newRol;

	}

	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();
		$count = 0;
		foreach ($this->rolList as $rol) {
			$valueArray['type'] = $rol->getType();
			$count = $count + 1;
			$valueArray['id'] = $count;
			

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){
		$this->rolList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$rol = new Rol($valueArray['id'],$valueArray['type']);
			
			array_push($this->rolList, $rol);
		}
    }




    function GetJsonFilePath(){

        $initialPath = "Data/roles.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}
?>
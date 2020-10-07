<?php 
namespace Dao;

use Dao\IUser as IUser;
use Models\User as User;

class UserDAO implements IUser{
    private $userList = array();

	
    public function add(User $newUser){
		$this->retrieveData();
		array_push($this->userList, $newUser);
		$this->saveData();
	}

	public function getAll(){
		$this->retrieveData();
		return $this->userList;
	}


	public function update(User $code){
		$this->retrieveData();
		$newList = array();
		foreach ($this->userList as $user) {
			if($user->getEmail() != $code->getEmail()){
				array_push($newList, $user);
			}
			else{
				array_push($newList,$code);
			}
		}
		

		$this->userList = $newList;
		$this->saveData();
	}


	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();

		foreach ($this->userList as $user) {
			$valueArray['name'] = $user->getName();
			$valueArray['lastname'] = $user->getLastName();
            $valueArray['email'] = $user->getEmail();
            $valueArray['username'] = $user->getUserName();
			$valueArray['password'] = $user->getPassword();
			array_push($arrayToEncode, $valueArray);
		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){
		
		$this->userList = array();

		$jsonPath = $this->GetJsonFilePath();

		// agregue condicional por si el archivo no existe
		if(file_exists($jsonPath))
		{
			$jsonContent = file_get_contents($jsonPath);
			
			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

			foreach ($arrayToDecode as $valueArray) {
				$user = new User($valueArray['username'],$valueArray['name'],$valueArray['lastname'],$valueArray['email'],$valueArray['password']);		
				array_push($this->userList, $user);
			}
		}
	}

	public function delete($code){
		$this->retrieveData();
		$newList = array();
		foreach ($this->userList as $user) {
			if($user->getEmail() != $code){
				array_push($newList, $user);
			}
		}
		

		$this->userList = $newList;
		$this->saveData();
	}

	public function search($email){

		$newuser = null;
		$this->retrieveData();
		foreach ($this->userList as $user) {
			if($user->getEmail() === $email){
				 $newuser = $user; 
			}
		}
		return $newuser;

	}
	
    function GetJsonFilePath(){

        $initialPath = ROOT."/Data/user.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}


?>
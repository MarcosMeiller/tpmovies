<?php 
namespace Dao;

use Dao\IUser as IUser;
use Models\User as User;
use Dao\Connection as Connection;

class UserDAO implements IUser{
    private $connection;
    private $tableName = "users";

	
    public function add(User $newUser) {
        $query = "INSERT INTO ".$this->tableName." (username, name, lastname,email,password,id_type) VALUES (:username, :name, :lastname, :email, :password,:id_type)";

        $parameters['name'] = $newUser->getName();
        $parameters['lastname'] = $newUser->getLastName();
        $parameters['email'] = $newUser->getEmail();
        $parameters['username'] = $newUser->getUserName();
        $parameters['password'] = $newUser->getPassword();
        $parameters['id_type'] = $newUser->getId_Type();     

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
        
    }

	public function getAll(){

            $query = "SELECT id, username, name, lastname,email,password,id_type FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $user = new User($row["id"],$row["username"],$row["name"],$row["lastname"],$row["email"],$row["password"]);
                $user->setId_Type($row['id_type']);
                $newUser->setId($newArray['idusers']);
                array_push($userList, $user);
            }

		return $this->userList;
	}


	
	public function search($email){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (email = :email)";
        $newUser = null;
        $parameters["email"] =  $email;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
            $newUser = new User($newArray['username'],$newArray['name'],$newArray['lastname'],$newArray['email'],$newArray['password']);
            $newUser->setId_Type($newArray['id_type']);
            // id user  CHAR
            }
        }
        return $newUser;

		
	}


	public function delete($code){
        $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] =  $code;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
	}


	
  
}


?>
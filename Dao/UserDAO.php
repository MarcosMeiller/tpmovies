<?php 
namespace Dao;

use Dao\IUser as IUser;
use Models\User as User;
use Dao\Connection as Connection;

class UserDAO implements IUser{
    private $connection;
    private $tableName = "users";

	
    public function add(User $newUser) {
        $query = "INSERT INTO ".$this->tableName." (id, username, name, lastname,email,password,id_type) VALUES (:id, :username, :name, :lastname, :email, :password,:id_type)";

        $valueArray['id'] = $user->getId();
        $valueArray['name'] = $user->getName();
        $valueArray['lastname'] = $user->getLastName();
        $valueArray['email'] = $user->getEmail();
        $valueArray['username'] = $user->getUserName();
        $valueArray['password'] = $user->getPassword();
        $valueArray['id_type'] = $user->getId_Type();     

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
    }

	public function getAll(){
		$cellPhoneList = array();

            $query = "SELECT id, username, name, lastname,email,password,id_type FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUserName($row["username"]);
                $user->setName($row["name"]);
                $user->setPassword($row["password"]);
                $user->setId_Type($row["id_type"]);
                $user->setEmail($row["email"]);
                $user->setLastName($row["lastname"]);
                array_push($userList, $user);
            }

		return $this->userList;
	}




	public function delete($code){
        $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] =  $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
	}


	
  
}


?>
<?php 
namespace Dao;

use Dao\IUser as IUser;
use Models\User as User;
use Dao\Connection as Connection;

class GenreDAO implements IGenre{
    private $connection;
    private $tableName = "users";

	
    public function add(Genre $newGenre) {
        $query = "INSERT INTO ".$this->tableName." (id,name) VALUES (:id,:name)";

        $genre->setId($row["id"]);
        $genre->setName($row["name"]);
 ;     

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
    }

	public function getAll(){
		$cellPhoneList = array();

            $query = "SELECT id, name FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $genre = new Genre();
                $genre->setId($row["id"]);
                $genre->setName($row["name"]);
         
                array_push($genreList, $genre);
            }

		return $this->genreList;
	}




	public function delete($code){
        $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] =  $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
	}


	
  
}


?>
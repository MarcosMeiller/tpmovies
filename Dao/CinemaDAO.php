<?php 
namespace Dao;
USE PDOException;
use FFI\Exception;
use Dao\ICinema as ICinema ;
use Models\Cinema as Cinema;
use Dao\Connection as Connection;

class cinemaDAO implements ICinema{
	private $cinemaList = array();
	private $connection;
	private $tableName = "cinemas";


    public function add(Cinema $newCinema){ 

		$sql = "INSERT INTO ".$this->tableName." (name,address) VALUES (:name,:address)";

		$parameters['name'] = $newCinema->getName();
		$parameters['address'] = $newCinema->getAddress();

		try{
			$this->connection = Connection::getInstance();

			return $this->connection->ExecuteNonQuery($sql,$parameters);

		}catch(Exception $ex){
			throw $ex;
		}
	}

	public function getAll(){ ///obtiene todos los datos
		$cinemasList = array();

		$query = "SELECT idcinemas, name, address FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            foreach($result as $row){
				$cinema = new Cinema($row["name"],$row["address"]);
				$cinema->setId($row['idcinemas']);
                array_push($cinemasList, $cinema);
			}
		return $cinemasList;
	}
 
	
	public function search($name){ 
		
		$query = "SELECT *  FROM ".$this->tableName." WHERE (name = :name)";
        $newCinema = null;
        $parameters["name"] =  $name;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
            $newCinema = new Cinema($newArray['name'],$newArray['address']);
            $newCinema->setId($newArray['idcinemas']);
            }
        }
        return $newCinema;

		

	}


    
    public function delete($id){///elimina un dato dentro de la lista
		$query = "DELETE FROM ".$this->tableName." WHERE (idcinemas = :idcinemas)";

        $parameters["idcinemas"] =  $id;

        $this->connection = Connection::GetInstance();

        return $this->connection->ExecuteNonQuery($query, $parameters);
	}

	public function update(Cinema $code){ ///reemplaza un objeto dentro de la 

		$query = "UPDATE ".$this->tableName." SET name=:name, address=:address  WHERE (idcinemas = :idcinemas)";

		$parameters['name'] = $code->getName();
		$parameters['address'] = $code->getAddress();
        $parameters["idcinemas"] =  $code->getId();

        $this->connection = Connection::GetInstance();

        return $this->connection->ExecuteNonQuery($query, $parameters);
	}



}


?>
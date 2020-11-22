<?php 
namespace Dao;

use Dao\IRoom as IRoom ;
use Models\Room as Room;
use PDOException;
class roomDAO implements IRoom{
    private $connection;
    private $tableName = "rooms";
	
    public function add(Room $newRoom){ ///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
		$query = "INSERT INTO ".$this->tableName." (id_cinema,name,capacity,price) VALUES (:id_cinema, :name, :capacity, :price)";

        $parameters['id_cinema'] = $newRoom->getId_Cinema();
        $parameters['name'] = $newRoom->getName();
        $parameters['capacity'] = $newRoom->getCapacity();
        $parameters['price'] = $newRoom->getPrice();
		
		   

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
		
	}

	public function getAll(){ ///obtiene todos los datos
		$query = "SELECT idrooms, id_cinema,name,capacity,price FROM ".$this->tableName;
			$roomsList = array();
            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $room = new Room($row["capacity"],$row["id_cinema"],$row["name"],$row["price"]);
				$room->setId($row['idrooms']);
                array_push($roomsList, $room);
            }
		return $roomsList;
	}

	public function getAllByCinema($id){ ///obtiene todos los datos segun el id de cinema
        
            $query = "SELECT * FROM ".$this->tableName." WHERE id_cinema = :id_cinema";
            
            $roomsList = array();

			$parameters["id_cinema"] =  (int)$id;

            $this->connection = Connection::GetInstance();
			
            $result = $this->connection->Execute($query,$parameters);
           

            foreach($result as $row)
            {
                $room = new Room($row["capacity"],$row["id_cinema"],$row["name"],$row["price"]);
				$room->setId($row['idrooms']);
                array_push($roomsList, $room);
            }        
		return $roomsList;
	}
    
    public function searchName($name){ ///busca un elemento dentro de la lista y retorna el objeto encontrado o null

		$query = "SELECT *  FROM ".$this->tableName." WHERE (name = :name)";
        $newRoom = null;
        $parameters["name"] =  $name;
        $validate = false;
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
          //  $newRoom = new Room($newArray['capacity'],$newArray['id_cinema'],$newArray['name'],$newArray['capacity']);
            //$newRoom->setId($newArray['idrooms']);
            $validate = true;
        }
        }
        return $validate;


    }

    public function searchIdCinema($id_Cinema){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (id_cinema = :id_cinema)";
        $newRoom = null;
        $parameters["id_cinema"] =  $id_Cinema;
        $validate = false;
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
          //  $newRoom = new Room($newArray['capacity'],$newArray['id_cinema'],$newArray['name'],$newArray['capacity']);
            //$newRoom->setId($newArray['idrooms']);
            $validate = true;
        }
        }
        return $validate;
    }

    public function searchRoomsbyIdCinema($id_Cinema){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (id_cinema = :id_cinema)";
        $newRoom = null;
        $arrayRoom= array();
        $parameters["id_cinema"] =  $id_Cinema;
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
                 $newRoom = new Room($newArray['capacity'],$newArray['id_cinema'],$newArray['name'],$newArray['capacity']);
                $newRoom->setId($newArray['idrooms']);
                array_push($arrayRoom,$newRoom);
            }
        }
        return $arrayRoom;
    }


	public function search($id){ ///busca un elemento dentro de la lista y retorna el objeto encontrado o null

		$query = "SELECT *  FROM ".$this->tableName." WHERE (idrooms = :idrooms)";
        $newRoom = null;
        $parameters["idrooms"] =  $id;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
            $newRoom = new Room($newArray['capacity'],$newArray['id_cinema'],$newArray['name'],$newArray['price']);
            $newRoom->setId($newArray['idrooms']);
            }
        }
        return $newRoom;


    }

	
	
    
    public function delete($code){///elimina un dato dentro de la lista
		$query = "DELETE FROM ".$this->tableName." WHERE (idrooms = :idrooms)";

        $parameters["idrooms"] =  $code;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
	}

	public function update(Room $code){ ///reemplaza un objeto dentro de la lista
	
		$query = "UPDATE ".$this->tableName." SET name=:name, id_cinema=:id_cinema, capacity = :capacity, price = :price  WHERE (idrooms = :idrooms)";

		$parameters['name'] = $code->getName();
		$parameters['id_cinema'] = $code->getId_Cinema();
        $parameters["capacity"] =  $code->getCapacity();
        $parameters["price"] = $code->getPrice();
        $parameters["idrooms"] = $code->getId();

        $this->connection = Connection::GetInstance();

        return $this->connection->ExecuteNonQuery($query, $parameters);
    }
    
    public function searchNameAndIdCinema($id_Cinema,$name){
        $query = "SELECT *  FROM ".$this->tableName." WHERE id_cinema = :id_cinema AND name = :name";
        $newRoom = null;
        $parameters["id_cinema"] =  $id_Cinema;
        $parameters["name"] =  $name;
        $validate = false;
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
          //  $newRoom = new Room($newArray['capacity'],$newArray['id_cinema'],$newArray['name'],$newArray['capacity']);
            //$newRoom->setId($newArray['idrooms']);
            $validate = true;
        }
        }
        return $validate;
    }

    

}

    
?>
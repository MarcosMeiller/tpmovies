<?php 
namespace Dao;

use Dao\IRol as IRol ;
use Models\Rol as Rol;

class RolDAO implements IRol{
	private $connection;
    private $tableName = "roles";


	
    public function add(Rol $newRol){
		$query = "INSERT INTO ".$this->tableName." (id_type, type) VALUES (:id_type,:type)";

        $parameters['id_type'] = $newRol->getId();
        $parameters['type'] = $newRol->getType();
          

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
	}

	public function getAll(){
	
		$query = "SELECT * FROM ".$this->tableName;

		$this->connection = Connection::GetInstance();

		$result = $this->connection->Execute($query);

		foreach($result as $row)
		{
			$rol = new Rol($row["id_type"],$row["type"]);
			$rol->setId($newArray['idroles']);
			array_push($rolList, $rol);
		}

		return $rolList;
	}
	
    
	public function search($id_type){

		$query = "SELECT *  FROM ".$this->tableName." WHERE (id_type = :id_type)";	
		$newRol = NULL;
		$parameters['id_type'] = $id_type;

		$this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		foreach($array as $newArray){
			if($newArray !== null){ 
				$newRol = new Rol($newArray['id_type'],$newArray['type']);
				$newRol->setId($newArray['idroles']);
			}
			
		}
		return $newRol;

	}


}
?>
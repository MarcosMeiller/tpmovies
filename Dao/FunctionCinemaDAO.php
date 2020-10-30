<?php 
namespace Dao;

//use Dao\IGenre as IGenre;
USE PDOException;
use FFI\Exception;
use DateTime;
use Models\FunctionCinema as FunctionCinema;
use Dao\Connection as Connection;
class FunctionCinemaDAO{
    private $connection;
    private $tableName = "functioncinemas";

    public function add(FunctionCinema $newFunction) {
        $query = "INSERT INTO ".$this->tableName." (id_room,id_movie,date,hour) VALUES (:id_room,:id_movie,:date,:hour)";

        $parameters['id_room'] = $newFunction->getId_Room();
        $parameters['id_movie'] = $newFunction->getId_Movie();
        $parameters['date'] = $newFunction->getDate();
        $parameters['hour'] = $newFunction->getHour();
		     
		try{
			$this->connection = Connection::GetInstance();
			return $this->connection->ExecuteNonQuery($query, $parameters);
		}catch(PDOException $ex){
            throw $ex;
        }
        
    }

    public function getAll(){

        $functionList = array();

        $query = "SELECT * FROM ".$this->tableName;
        try{
        $this->connection = Connection::GetInstance();

        $result = $this->connection->Execute($query);

        foreach($result as $row)
        {
            $functionCinema = new FunctionCinema($row['id_room'],$row['id_movie'],$row['date'],$row['hour']);
            $functionCinema->setId($row['idfunctioncinemas']);///cambiarle el nombre cuando haga la base de datos.

         
     
            array_push($functionList, $functionCinema);
        }
    }
    catch(PDOException $ex){
        throw $ex;
    }
    return $functionList;
}

public function Search($id){
    $query = "SELECT *  FROM ".$this->tableName." WHERE (idfunctioncinemas = :idfunctioncinemas)";
        $newFunction = null;
        $parameters["idfunctioncinemas"] =  $id;
        try{
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
            foreach($array as $newArray){
                if($newArray !== null){
                    $newFunction = new FunctionCinema($parameters['id_room'],$parameters['id_movie'],$parameters['date'],$parameters['hour']);
                    $newFunction->setId($parameters['idfunctioncinemas']);
                }
        }
        return $newFunction;
    }    
    catch(PDOException $ex){
        throw $ex;
    }  
}

public function validFunction(FunctionCinema $function,FunctionCinema $newFunction){
    $isValid = true;
    $date1 = new DateTime($function->getDate());//serian las fechas actuales
    $date2 = new DateTime($newFunction->getDate());// irian las fechas nueva
    $date3 = new DateTime($function->getHour());//irian las horas //deberia compararlo asi y sumandole el get duration.
    $date4 = new DateTime($newFunction->getHour());// irian la hora nueva


    if($date1 == $date2){
        $diff = $date3->diff($date4);
        $resultado = ($diff->days * 24 ) * 60  + ( $diff->i ); 
    
        if($resultado <= 15){
            $isValid = false;
        }

    }
    return $isValid;


}


}










?>
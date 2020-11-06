<?php 
namespace Dao;

//use Dao\IGenre as IGenre;
USE PDOException;
use DateTime;
use Models\FunctionCinema as FunctionCinema;
use Dao\Connection as Connection;
class FunctionCinemaDAO{
    private $connection;
    private $tableName = "functioncinemas";

    public function add(FunctionCinema $newFunction) {
        $exist = $this->controlDateMovie($newFunction);
        if($exist == null){
        $query = "INSERT INTO ".$this->tableName." (room_id,movie_id,date,hour) VALUES (:room_id,:movie_id,:date,:hour)";

        $parameters['room_id'] = $newFunction->getId_Room();
        $parameters['movie_id'] = $newFunction->getId_Movie();
        $parameters['date'] = $newFunction->getDate();
        $parameters['hour'] = $newFunction->getHour();
        
            try{
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(PDOException $ex){
                throw $ex;
            }
        }
        else{
            return $exist;
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
            $functionCinema = new FunctionCinema($row['room_id'],$row['movie_id'],$row['date'],$row['hour']);
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
    $query = "SELECT *  FROM ".$this->tableName." WHERE (movie_id = :movie_id)";
        $newFunction = null;
        $parameters["id_movie"] =  $id;
        try{
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
            foreach($array as $newArray){
                if($newArray !== null){
                    $newFunction = new FunctionCinema($parameters['room_id'],$parameters['movie_id'],$parameters['date'],$parameters['hour']);
                    $newFunction->setId($parameters['idfunctioncinemas']);
                }
        }
        return $newFunction;
    }    
    catch(PDOException $ex){
        throw $ex;
    }  
}

public function FilterList($date){
    $query = "SELECT *  FROM ".$this->tableName." WHERE (date = :date)";
    $parameters["date"] =  $date;
    $arrayFunction = array();
    try{
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
            foreach($array as $newArray){
                if($newArray !== null){
                    $newFunction = new FunctionCinema($parameters['room_id'],$parameters['movie_id'],$parameters['date'],$parameters['hour']);
                    $newFunction->setId($parameters['idfunctioncinemas']);
                }
                array_push($arrayFunction,$newFunction);
        }
        return $arrayFunction;
    }    
    catch(PDOException $ex){
        throw $ex;
    }  
}
   
public function delete($id){///elimina un dato dentro de la lista
    $query = "DELETE FROM ".$this->tableName." WHERE (idfunctioncinemas = :idfunctioncinemas)";

    $parameters["idfunctioncinemas"] =  $id;

    $this->connection = Connection::GetInstance();

    return $this->connection->ExecuteNonQuery($query, $parameters);
}

public function update(FunctionCinema $code){ ///reemplaza un objeto dentro de la 

    $exist = $this->controlDateMovieWhenUpdate($code);

    if($exist == null){
        $query = "UPDATE ".$this->tableName." SET room_id=:room_id, movie_id=:movie_id, date=:date, hour=:hour WHERE (idfunctioncinemas = :idfunctioncinemas)";

        $parameters["room_id"] =  $code->getId_Room();
        $parameters["movie_id"] =  $code->getId_Movie();
        $parameters['date'] = $code->getDate();
        $parameters['hour'] = $code->getHour();
        $parameters["idfunctioncinemas"]  = $code->getId();


        try{
            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($query, $parameters);
        }catch(PDOEXception $e){
            throw $e;
        } 
    }
    else{
        return $exist;
    }
}


public function controlDateMovie(FunctionCinema $newFunction){
    $array = $this->getAll();
    $validate = null;
    foreach($array as $function){
        if($function->getDate() == $newFunction->getDate() && $function->getId_Movie() == $newFunction->getId_Movie())
        {
            $validate = "exist";
        }
    }
    return $validate;
}

public function controlDateMovieWhenUpdate(FunctionCinema $newFunction){
    $array = $this->getAll();
    $validate = null;
    foreach($array as $function){
        if($function->getDate() == $newFunction->getDate() && $function->getId_Movie() == $newFunction->getId_Movie() && $newFunction->getId() != $function->getId() )
        {
            $validate = "exist";
        }
    }
    return $validate;
}

public function validFunction(FunctionCinema $function,FunctionCinema $newFunction){
    $isValid = true;
    $date1 = new DateTime($function->getDate());//serian las fechas actuales
    $date2 = new DateTime($newFunction->getDate());// irian las fechas nueva
    $date3 = new DateTime($function->getHour());//irian las horas //deberia compararlo asi y sumandole el get duration.
    $date4 = new DateTime($newFunction->getHour());// irian la hora nueva


    if($date1 == $date2){
        $diff = $date3->diff($date4);
        $resultado = abs (($diff->days * 24 ) * 60  + ( $diff->i )); 
    
        if($resultado <= 15){
            $isValid = false;
        }

    }
    return $isValid;


}

public function getFunctionbyMovie($id_movie){
    $query = "SELECT *  FROM ".$this->tableName." WHERE (movie_id = :movie_id)";
        $parameters["id_movie"] =  $id_movie;
        try{
        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
    
        return $array;
    }    
    catch(PDOException $ex){
        throw $ex;
    }  
}


}




?>
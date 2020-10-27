<?php 
namespace Dao;

use Dao\IGenre as IGenre;
use Models\Genre as Genre;
use Dao\Connection as Connection;

class GenreDAO implements IGenre{
    private $connection;
    private $tableName = "genres";

	
    public function add(Genre $newGenre) {
        $query = "INSERT INTO ".$this->tableName." (idgenres,name) VALUES (:idgenres,:name)";

        $parameters['idgenres'] = $newGenre->getId();
		$parameters['name'] = $newGenre->getName();
		     
		try{
			$this->connection = Connection::GetInstance();
			return $this->connection->ExecuteNonQuery($query, $parameters);
		}catch(PDOException $ex){
            throw $ex;
        }
        
    }

	public function getAll(){

			$genreList = array();

            $query = "SELECT idgenres, name FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);


			if(empty($result)){

				$this->retrieveDataFromAPI();
				$result = $this->connection->Execute($query);
			}

            foreach($result as $row)
            {
                $genre = new Genre($row['idgenres'],$row['name']);
             
         
                array_push($genreList, $genre);
            }

		return $genreList;
	}


	public function retrieveDataFromAPI(){
		//llena el json con los datos de la api		public function retrieveDataFromAPI(){//llena el json con los datos de la api
		$this->genreList = array();	
		$genresdb = file_get_contents(API_HOST.'/genre/movie/list?api_key='.API_KEY.'&language='.LANG);	

		$genres = json_decode($genresdb,true,)['genres'];

		foreach($genres as $genre){	
			$gen = new Genre($genre['id'],$genre['name']);

			$this->add($gen);
		}
	} 	

	public function delete($code){
        $query = "DELETE FROM ".$this->tableName." WHERE (idgenres = :idgenres)";

        $parameters["idgenres"] =  $code;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);
	}


	
  
}


?>
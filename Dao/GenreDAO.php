<?php 
namespace Dao;

use Dao\IGenre as IGenre;
use Models\Genre as Genre;

class GenreDao implements IGenre{
    private $genreList = array();

	
    public function add(Genre $newGenre){///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
		$sql = "INSERT INTO ".$this->tableCinema." (name,address) VALUES (:name,:address)";

		$parameters['id_genre'] = $newGenre->getId();
		$parameters['name'] = $newGenre->getName();

		try{
			$this->connection = Connection::getInstance();

			return $this->connection->ExecuteNonQuery($sql,$parameters);

		}catch(Exception $ex){
			throw $ex;
		}
	}

	public function getAll(){ ///obtiene todos los datos y en caso de que la lista este vacia la llena con la api
		$query = "SELECT id_genre, name  FROM ".$this->tableName;

		$this->connection = Connection::GetInstance();

		$result = $this->connection->Execute($query);

		foreach($result as $row)
		{
			$genre = new Genre($row["id_genre"],$row["name"]);
			array_push($genreList, $genre);
		}

		return $this->genreList;
	}


	
	public function delete($code){///elimina un dato dentro de la lista
		/*$this->retrieveData();
		$newList = array();
		foreach ($this->genreList as $genre) {
			if($genre->getId() != $code){
				array_push($newList, $genre);
			}
		}
		

		$this->genreList = $newList;
		$this->saveData();*/
	}

	public function search($id){

		$query = "SELECT *  FROM ".$this->tableName." WHERE (id_genre = :id_genre)";	
		$newGenre = null;
		$parameters['id_genre'] = $id;

		$this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		foreach($array as $newArray){
			if($newArray !== null){ 
				$newGenre = new Genre($newArray['id_genre'],$array['name']);
			}
			
		}
		
		return $newGenre;

	}



	public function retrieveDataFromAPI(){//llena el json con los datos de la api
		$genresdb = file_get_contents(API_HOST.'/genre/movie/list?api_key='.API_KEY.'&language='.LANG);
		$genres = json_decode($genresdb,true,)['genres'];
		foreach($genres as $genre){
			$id = $genre['id'];
			$name = $genre['name'];
			$g = new Genre($id,$name);
			$this->add($g);
		}
	} 


	/*public function getForGenre($arrayMovie,$Arraygenre){//recibe 2 arrays y filtra una lista de peliculas x generos.
		$this->retrieveData();
		$aux = $arrayMovie;
		$searched = array();
		$aux2;
		foreach($arrayGenre as $genre){
			foreach($this->aux as $movie){
				$aux2 = search($genre,$movie->getGenre());
					if($aux2 !== null && array_search($movie,$searched)){
						$searched[] = $movie;
					}
				}
			}
		
		return $searched;
	}*/
}


?>
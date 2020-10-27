<?php 
namespace Dao;

use Dao\IMovie as IMovie;
use Models\Movie as Movie;

class MovieDAO implements IMovie{
	private $connection;
    private $tableName = "movies";

	
    public function add(Movie $newMovie){///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
		
		/*$query = "INSERT INTO ".$this->tableName." (id_movie, title,genres_id,overview,poster_path,backdrop,adult,language,original_language,relase_date,duration) VALUES (:username, :name, :lastname, :email, :password,:id_type)";*/

		$query = "INSERT INTO ".$this->tableName." (id_movie, title) VALUES (:id_movie,:title)";

        $parameters['id_movie'] = $newMovie->getId_Movie();
        $parameters['title'] = $newMovie->getTitle();
        /*$parameters['genres_id'] = $newMovie->getGenre_Id();
        $parameters['overview'] = $newMovie->getOverview();
        $parameters['poster_path'] = $newMovie->getPoster_Path();
		$parameters['backdrop'] = $newMovie->getBackdrop();  
		$parameters['adult'] = $newMovie->getAdult();    
		$parameters['language'] = $newMovie->getLanguage();    
		$parameters['original_language'] = $newMovie->getOriginal_Language();
		$parmaters['duration'] = $newMovie->getDuration();    */
		   

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
		
	}

	public function getAll($id){ ///obtiene todos los datos y en caso de que este vacio los rellena con los datos de la api, ademas si recibe un id retorna la lista solo con los generos de ese id.
		//$movielist = 
		$movieList = array();

		//$query = "SELECT id_movie, title,genres_id,overview,poster_path,backdrop,adult,language,original_language,relase_date,duration FROM ".$this->tableName;
		$query = "SELECT idmovies, id_movie, title FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);


            foreach($result as $row)
            {
				/*$movie = new Movie($row["id_movie"],$row["title"],$row["genres_id"],$row["overview"],$row["poster_Path"],$row["backdrop"],$row["adult"],$row["language"],$row["original_language"],$row["release_date"],$row["duration"]);*/

				$movie = new Movie($row["id_movie"],$row["title"]);
				

				$movie->setId($row['idmovies']);
                array_push($movieList, $movie);
            }
		$size = 0;
		if($movieList !== []){
			$size = 1;
		}
		if($size === 0){
            $this->retrieveDataFromAPI();
		}
		
		if($id !== 0 && $id !== "TODAS"){

			$moviesFilter = array();
			$array_ids = array();
			
			foreach($movieList as $movie){
				$array_ids = $movie->getGenre_Id();
				foreach($array_ids as $genId){
					if($genId == $id){
						
						$moviesFilter[] = $movie;
					}
					}
				}
				
			$movieList = $moviesFilter;	
		}
		return $movieList;
	}

	public function update(Movie $code){///reemplaza un objeto dentro de la lista
		$newList = array(); //sin actualizar.
		foreach ($this->movieList as $movie) {
			if($movie->getId() != $code->getId()){
				array_push($newList, $movie);
			}
			else{
				array_push($newList,$code);
			}
		}
		

		$this->movieList = $newList;
	
	}


	
	public function delete($code){///elimina un dato dentro de la lista
		$newList = array();
		foreach ($this->movieList as $movie) {
			if($movie->getId() != $code){
				array_push($newList, $movie);
			}
		}
		

		$this->movieList = $newList;
		
	}

	public function search($id){

		$query = "SELECT *  FROM ".$this->tableName." WHERE (id_movie = :id_movie)";
        $newMovie = null;
        $parameters["id_movie"] =  $id;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
			/*$newMovie= new Movie($parameters["id_movie"],$parameters["title"],$parameters["genres_id"],$parameters["overview"],$parameters["poster_Path"],$parameters["backdrop"],$parameters["adult"],$parameters["language"],$parameters["original_language"],$parameters["release_date"],$parameters["duration"]);
			$newMovie->setId($parameters['idMovies']);*/
			$newMovie= new Movie($parameters["id_movie"],$parameters["title"]);
			
            }
        }
        return $newMovie;


	}

	public function searchMovieID($id){

		$newMovie = $this->getAll(0);
		foreach ($this->movieList as $movie) {
			if($movie->getId_Movie() == $id){
				 $newMovie = $movie; 
			}
		}
		return $newMovie;

	}

	

	
	public function retrieveDataFromAPI(){
		$moviedb = file_get_contents(API_HOST.'/movie/now_playing?api_key='.API_KEY.'&language='.LANG.'&page=1');
		$movies = json_decode($moviedb,true,)['results'];
		/*foreach($movies as $movie){
			$id = 1;
			$id_Movie = $movie['id'];
			$title = $movie['title'];
			$genres_id = $movie['genre_ids'];
			$overview = $movie['overview'];
			$poster_Path = $movie['poster_path'];
			$backdrop = $movie['backdrop_path'];
			$adult = $movie['adult'];
			$language = "es-ar";
			$original_language = $movie['original_language'];
			$release_date = $movie['release_date'];
			$duration = 0;
			$g = new Movie($id,$id_Movie,$title,$genres_id,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date,$duration);
			$this->add($g);
		}*/

		foreach($movies as $movie){	
			$id_Movie = $movie['id'];
			$title = $movie['title'];
			$g = new Movie($id_Movie,$title);
			$this->add($g);
		}

	} 

	public function getForGenre($Genre){
		$listMovie = $this->getAll(0);
		$movielistForGenre = array();
		foreach($listMovie as $movieForGenre){
			foreach($movieForGenre->getGenre_id() as $genre_Id){
				if($Genre == $genre_Id){
					$movielistForGenre = $movieForGenre;
				}
				}
			}
		
		return $movielistForGenre;
	}

	public function getNamesGenres($genresList,$arrayIds){
		
		$namesGenres = array();

		foreach($arrayIds as $id){
			foreach($genresList as $genre){
				if($id === $genre->getId()){
					$namesGenres[] = $genre->getName();
				}
			}
		}
		return $namesGenres;
	}
}


?>
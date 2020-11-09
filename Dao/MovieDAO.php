<?php 
namespace Dao;

USE PDOException;
use Dao\IMovie as IMovie;
use Models\Movie as Movie;

class MovieDAO implements IMovie{
	private $connection;
    private $tableName = "movies";

	
    public function add(Movie $newMovie){///Carga la lista guardada, ingresa un dato y lo guarda dentro de la lista.
	

		$query = "INSERT INTO ".$this->tableName." (id_movie, title,overview,poster_path,backdrop,adult,language,original_language,duration,release_date) VALUES (:id_movie,:title,:overview,:poster_path,:backdrop,:adult,:language,:original_language,:duration,:release_date)";
	
        $parameters['id_movie'] = $newMovie->getId_Movie();
        $parameters['title'] = $newMovie->getTitle();
        $parameters['overview'] = $newMovie->getOverview();
        $parameters['poster_path'] = $newMovie->getPoster_Path();
		$parameters['backdrop'] = $newMovie->getBackdrop();  
		$parameters['adult'] = $newMovie->getAdult();    
		$parameters['language'] = $newMovie->getLanguage();    
		$parameters['original_language'] = $newMovie->getOriginal_Language();
		$parameters['release_date'] = $newMovie->getRelease_date();
		$parameters['duration'] = $newMovie->getDuration(); 
	
        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
		
	}

	public function getAll($id){ ///obtiene todos los datos y en caso de que este vacio los rellena con los datos de la api, ademas si recibe un id retorna la lista solo con los generos de ese id.
	
		$movieList = array();

		$query = "SELECT idmovies, id_movie, title,overview,poster_path,backdrop,adult,language,original_language,release_date,duration FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

		

            foreach($result as $row)
            {
				$movie = new Movie($row["id_movie"],$row["title"],$row["overview"],$row["poster_path"],$row["backdrop"],$row["adult"],$row["language"],$row["original_language"],$row["release_date"],$row["duration"]);

				//$movie = new Movie($row["id_movie"],$row["title"]);
				

				$movie->setId($row['idmovies']); 
                array_push($movieList, $movie);
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


	
    public function deleteMovieforAdmin($id){///elimina un dato dentro de la lista
		$query = "DELETE FROM moviesxadmin WHERE (idmoviesxadmin = :idmoviesxadmin)";

        $parameters["idmoviesxadmin"] =  $id;

        $this->connection = Connection::GetInstance();

        return $this->connection->ExecuteNonQuery($query, $parameters);
	}

	/*public function update(Cinema $code){ ///reemplaza un objeto dentro de la 

		$query = "UPDATE ".$this->tableName." SET name=:name, address=:address  WHERE (idcinemas = :idcinemas)";

		$parameters['name'] = $code->getName();
		$parameters['address'] = $code->getAddress();
        $parameters["idcinemas"] =  $code->getId();

        $this->connection = Connection::GetInstance();

        return $this->connection->ExecuteNonQuery($query, $parameters);
	}*/

	public function search($id){

		$query = "SELECT *  FROM ".$this->tableName." WHERE (id_movie = :id_movie)";
        $newMovie = null;
        $parameters["id_movie"] =  $id;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
			$newMovie= new Movie($newArray["id_movie"],$newArray["title"],$newArray["overview"],$newArray["poster_path"],$newArray["backdrop"],$newArray["adult"],$newArray["language"],$newArray["original_language"],$newArray["release_date"],$newArray["duration"]);
			$newMovie->setId($newArray['idmovies']);
			/*$newMovie= new Movie($parameters["id_movie"],$parameters["title"]);
			*/
            }
        }
        return $newMovie;


	}

	public function searchMovieIdApi($id){

		$query = "SELECT * FROM ".$this->tableName."  WHERE (id_movie = :id_movie)";
        $newMovie = null;
        $parameters["id_movie"] =  $id;

        $this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		

        foreach($array as $newArray){
            if($newArray !== null){ 
				$newMovie= new Movie($newArray["id_movie"],$newArray["title"],$newArray["overview"],$newArray["poster_path"],$newArray["backdrop"],$newArray["adult"],$newArray["language"],$newArray["original_language"],$newArray["release_date"],$newArray["duration"]);
				$newMovie->setId($newArray['idmovies']);
			}
		}
		
        return $newMovie;


	}

	public function retriveMoviexAdmin(){
		$moviedb = file_get_contents(API_HOST.'/movie/now_playing?api_key='.API_KEY.'&language='.LANG.'&page=1');
		$movies = json_decode($moviedb,true,)['results'];
		/*$arraymovies = array();
		foreach($movies as $movie){
			$movieD= new Movie($movie["id"],$movie["title"]);
			$movieD->setGenre_Id("genres_id");
			$movieD->setOverview("overview");
			$movieD->setPoster_Path("poster_path");
			$movieD->setBackdrop("backdrop_path");
			$movieD->setLanguage("es-ar");
			$movieD->setOriginal_Language("original_language");
			$movieD->setRelease_date("release_date");
			$movieD->setAdult("adult");
			array_push($arraymovies,$movieD);

		}	
		return $arraymovies;
		*/
		return $movies;
	}

	public function addMoviexAdmin($id_Admin,$id_movie){


		$query = "INSERT INTO moviesxadmin (idadmin,idmovie) VALUES (:idadmin,:idmovie)";
		$parameters['idadmin'] = $id_Admin;
		$parameters['idmovie'] = $id_movie;
	

		try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }

	}

	public function getMoviexAdmin($id_admin){

		$query = "SELECT idmoviesxadmin, id_movie 
		from moviesxadmin AS ma
		INNER JOIN movies AS m ON ma.idmovie = m.idmovies
		WHERE ma.idadmin = :idadmin";
		$parameters["idadmin"] = $id_admin;
		
		try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->Execute($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }



	}


	public function add2(Movie $newMovie){
		$query = "INSERT INTO "."moviesxadmin". "VALUE(:id_movie, :title,:genres_id,:overview,:poster_path,:backdrop,:adult,:language,:original_language,:release_date,:duration)";
		$parameters['id_movie'] = $newMovie->getId_Movie();
        $parameters['title'] = $newMovie->getTitle();
       
        $parameters['overview'] = $newMovie->getOverview();
        $parameters['poster_path'] = $newMovie->getPoster_Path();
		$parameters['backdrop'] = $newMovie->getBackdrop();  
		$parameters['adult'] = $newMovie->getAdult();    
		$parameters['language'] = $newMovie->getLanguage();    
		$parameters['original_language'] = $newMovie->getOriginal_Language();
		$parameters['duration'] = $newMovie->getDuration();    
		   

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }

	}

	public function searchMovieID($id){

		/*$newMovie = $this->getAll(0);
		foreach ($this->movieList as $movie) {
			if($movie->getId_Movie() == $id){
				 $newMovie = $movie; 
			}
		}
		return $newMovie;*/

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
			$g = new Movie($id,$id_Movie,$title,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date,$duration);
			$this->add($g);
		}
*/
	
		return $movies;

	} 

	// trae la movie completa de la api y retorna el id
	public function getMovieFromAPI($id){

		$movie = $this->searchMovieIdApi($id);
	
		$genres_id = array();
		if($movie == null ){
			$moviedb = file_get_contents(API_HOST.'/movie/'.$id.'?api_key='.API_KEY.'&language='.LANG);
			$movie = json_decode($moviedb,true,);
			$id_Movie = $movie['id'];
			$title = $movie['title'];
			$overview = $movie['overview'];
			$poster_Path = $movie['poster_path'];
			$backdrop = $movie['backdrop_path'];
			$adult = $movie['adult'];
			$language = "es-ar";
			$original_language = $movie['original_language'];
			$release_date = $movie['release_date'];
			$duration = $movie['runtime'];
			$g = new Movie($id_Movie,$title,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date,$duration);
			$this->add($g);
			$movieCharged = $this->searchMovieIdApi($id);
			foreach($movie['genres'] as $genres){
				$this->addMoviesxGenres($movieCharged->getId(),$genres['id']);
				
			}
		
			return $movieCharged->getId();
		}else{
			return $movie->getId();
		}

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

	public function addMoviesxGenres($idmovie,$idgenre){
		$query = "INSERT INTO moviesxgenres (idmovie,idgenre) VALUES (:idmovie, :idgenre)";
		
		$parameters['idmovie'] = $idmovie;
		$parameters['idgenre'] = $idgenre;


        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }

	}

	// buscar los generos de la pelicula
	public function getGenresofMovie($idmovie){
		$query = "SELECT idmovie,idgenre  FROM moviesxgenres WHERE (idmovie = :idmovie)";
		$parameters['idmovie'] = $idmovie;
		try{
			$this->connection = Connection::GetInstance();
			$array = $this->connection->Execute($query, $parameters);
			return $array;
		}
		catch(PDOException $ex){
            throw $ex;
        }
	}


	public function getMoviesForGenre($id_Genre){
	
		$query = "SELECT * FROM moviesxgenres  WHERE (idgenre = :idgenre)";
        $newMovie = array();
        $parameters["idgenre"] =  $id_Genre;

        $this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		

        foreach($array as $newArray){
			$newMovie[] = $this->searchIdBdd($newArray['idmovie']);
		}
		
        return $newMovie;	
	}

	public function searchIdBdd($id){

		$query = "SELECT *  FROM ".$this->tableName." WHERE (idmovies = :idmovies)";
        $newMovie = null;
        $parameters["idmovies"] =  $id;

        $this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		

        foreach($array as $newArray){
            if($newArray !== null){ 
			$newMovie= new Movie($newArray["id_movie"],$newArray["title"],$newArray["overview"],$newArray["poster_path"],$newArray["backdrop"],$newArray["adult"],$newArray["language"],$newArray["original_language"],$newArray["release_date"],$newArray["duration"]);
			$newMovie->setId($newArray['idmovies']);
			/*$newMovie= new Movie($parameters["id_movie"],$parameters["title"]);
			*/
            }
        }
        return $newMovie;


	}

	public function searchIdMoviexAdmin($idmovie){
		$query = "SELECT *  FROM moviesxadmin WHERE (idmovie = :idmovie)";
        $newMovie = null;
        $parameters["idmovie"] =  $idmovie;
		
        $this->connection = Connection::GetInstance();
		$array = $this->connection->Execute($query, $parameters);
		

        foreach($array as $newArray){
            if($newArray !== null){ 
				$idmovie = $newArray['idmoviesxadmin'];
            }
		}
		var_dump($array);
        die;
        return $idmovie;
	}

}


?>
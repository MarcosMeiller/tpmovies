<?php 
namespace Dao;

use Dao\IMovie as IMovie;
use Models\Movie as Movie;

class MovieDAO implements IMovie{
    private $movieList = array();

	
    public function add(Movie $newMovie){
		$this->retrieveData();
		array_push($this->movieList, $newMovie);
		$this->saveData();
	}

	public function getAll($id){
		$this->retrieveData();
	
		$size = 0;
		if($this->movieList !== []){
			$size = 1;
		}
		if($size === 0){
            $this->retrieveDataFromAPI();
		}
		
		if($id !== 0 && $id !== "TODAS"){

			$moviesFilter = array();
			$array_ids = array();
			
			foreach($this->movieList as $movie){
				$array_ids = $movie->getGenre_Id();
				foreach($array_ids as $genId){
					if($genId == $id){
						
						$moviesFilter[] = $movie;
					}
					}
				}
				
			$this->movieList = $moviesFilter;	
		}
		return $this->movieList;
	}

	public function update(Movie $code){
		$this->retrieveData();
		$newList = array();
		foreach ($this->movieList as $movie) {
			if($movie->getId() != $code->getId()){
				array_push($newList, $movie);
			}
			else{
				array_push($newList,$code);
			}
		}
		

		$this->movieList = $newList;
		$this->saveData();
	}


	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();
		$count = 0;
		foreach ($this->movieList as $movie) {
			$count = $count + 1;
			$valueArray['id'] = $count;
			$valueArray['id_movie'] = $movie->getId_Movie();
			$valueArray['title'] = $movie->getTitle();
            $valueArray['genres_id'] = $movie->getGenre_Id();
			$valueArray['overview'] = $movie->getOverview();
			$valueArray['poster_Path'] = $movie->getPoster_Path();
			$valueArray['backdrop'] = $movie->getBackdrop();
			$valueArray['adult'] = $movie->getAdult();
			$valueArray['language'] = $movie->getLanguage();
			$valueArray['original_language'] = $movie->getOriginal_Language();
			$valueArray['release_date'] = $movie->getRelease_date();
			
		 
			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function delete($code){
		$this->retrieveData();
		$newList = array();
		foreach ($this->movieList as $movie) {
			if($movie->getId() != $code){
				array_push($newList, $movie);
			}
		}
		

		$this->movieList = $newList;
		$this->saveData();
	}

	public function search($id){

		$newMovie = null;
		$this->retrieveData();
		foreach ($this->movieList as $movie) {
			if($movie->getId() === $id){
				 $newMovie = $movie; 
			}
		}
		return $newMovie;

	}

	public function retrieveData(){
		$this->movieList = array();

		$jsonPath = $this->GetJsonFilePath();
		if(file_exists($jsonPath))
		{
		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$movie = new Movie($valueArray['id'],$valueArray['id_movie'],$valueArray['title'],$valueArray['genres_id'],$valueArray['overview'],$valueArray['poster_Path'],$valueArray['backdrop'],$valueArray['adult'],$valueArray['language'],$valueArray['original_language'],$valueArray['release_date']);
			
			array_push($this->movieList, $movie);
		}
	}
	}

    function GetJsonFilePath(){

        $initialPath = ROOT."/Data/movies.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
	}
	
	public function retrieveDataFromAPI(){
		$moviedb = file_get_contents(API_HOST.'/movie/now_playing?api_key='.API_KEY.'&language='.LANG.'&page=1');
		$movies = json_decode($moviedb,true,)['results'];
		foreach($movies as $movie){
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
			$g = new Movie($id,$id_Movie,$title,$genres_id,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date);
			$this->add($g);
		}
	} 

	public function getForGenre($Genre){
		$listMovie = $this->retrieveData();
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
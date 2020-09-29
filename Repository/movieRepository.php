<?php 
namespace repository;

use repository\IMovie as IMovie;
use model\movie as Movie;

class movieRepository implements IMovie{
    private $movieList = array();

	
    public function add(Movie $newMovie){
		$this->retrieveData();
		array_push($this->movieList, $newMovie);
		$this->saveData();
	}

	public function getAll(){
		$this->retrieveData();
		return $this->movieList;
	}


	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();

		foreach ($this->movieList as $movie) {
			$valueArray['name'] = $movie->getName();
			$valueArray['direct'] = $movie->getDirect();
			$valueArray['duration'] = $movie->getDuration();
            $valueArray['genre'] = $movie->getGenre();
            $valueArray['description'] = $movie->getDescription();

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function retrieveData(){
		$this->movieList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$movie = new Movie($valueArray['name'],$valueArray['direct'],$valueArray['duration'],$valueArray['genre'],$valueArray['description']);
			
			array_push($this->movieList, $movie);
		}
	}

    function GetJsonFilePath(){

        $initialPath = "Data/movie.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
}


?>
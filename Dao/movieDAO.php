<?php 
namespace Dao;

use Dao\IMovie as IMovie;
use model\movie as Movie;

class movieDAO implements IMovie{
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
			$valueArray['id'] = $movie->getId();

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

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$movie = new Movie($valueArray['name'],$valueArray['direct'],$valueArray['duration'],$valueArray['genre'],$valueArray['description'],$valueArray['id']);
			
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
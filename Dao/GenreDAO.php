<?php 
namespace Dao;

use Dao\IGenre as IGenre;
use Models\Genre as Genre;

class GenreDao implements IGenre{
    private $genreList = array();

	
    public function add(Genre $newGenre){
		$this->retrieveData();
		array_push($this->genreList, $newGenre);
		$this->saveData();
	}

	public function getAll(){
		$genres = $this->retrieveData();
		$size = 0;
		if($genres !== null){
			$size = sizeOf($genres);
		}
		if($size === 0 ){
            $this->retrieveDataFromAPI();
        }
		return $this->genreList;
	}


	public function saveData(){
		$arrayToEncode = array();
		$jsonPath = $this->GetJsonFilePath();
		$count = 0;
		foreach ($this->genreList as $genre) {
            $valueArray['id'] = $genre->getId();
			$valueArray['name'] = $genre->getName();

			array_push($arrayToEncode, $valueArray);

		}
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($jsonPath, $jsonContent);
	}

	public function delete($code){
		$this->retrieveData();
		$newList = array();
		foreach ($this->genreList as $genre) {
			if($genre->getId() != $code){
				array_push($newList, $genre);
			}
		}
		

		$this->genreList = $newList;
		$this->saveData();
	}

	public function search($id){

		$newGenre = null;
		$this->retrieveData();
		foreach ($this->genreList as $genre) {
			if($genre->getId() === $id){
				 $newGenre = $genre; 
			}
		}
		return $newGenre;

	}

	public function retrieveData(){
		$this->genreList = array();

		$jsonPath = $this->GetJsonFilePath();

		$jsonContent = file_get_contents($jsonPath);
		
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

		foreach ($arrayToDecode as $valueArray) {
			$genre = new Genre($valueArray['id'],$valueArray['name']);
			
			array_push($this->genreList, $genre);
		}
	}

	public function retrieveDataFromAPI(){
		$this->genreList = array();
		$genresdb = file_get_contents(API_HOST.'/genre/movie/list?api_key='.API_KEY.'&language='.LANG);
		$genres = json_decode($genresdb,true,)['genres'];
		foreach($genres as $genre){
			$id = $genre['id'];
			$name = $genre['name'];
			$g = new Genre($id,$name);
			$this->add($g);
		}
	} 

    function GetJsonFilePath(){

        $initialPath = "Data/genres.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
	}
	
	/*public function getForGenre($arrayMovie,$Arraygenre){
		$this->retrieveData();
		$aux = $arrayMovie;
		$searched = array();
		$aux2;
		fore ach($arrayGenre as $genre){
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
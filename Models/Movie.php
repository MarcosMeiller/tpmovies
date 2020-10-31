<?php 

namespace models;

class Movie{
    private $id;
    private $id_Movie;
    private $title;
    private $overview;
    private $poster_Path;
    private $backdrop;
    private $adult;
    private $language;
    private $original_language;
    private $release_date;
    private $duration;

    public function __construct($id_Movie,$title,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date,$duration){

        $this->id_Movie = $id_Movie;
        $this->title = $title;
        $this->overview = $overview;
        $this->poster_Path = $poster_Path;
        $this->backdrop = $backdrop;
        $this->adult = $adult;
        $this->language = $language;
        $this->original_language = $original_language;
        $this->release_date = $release_date;
        $this->duration = $duration;
  
    }

    public function getId(){
        return $this->id;
    }

    public function getId_Movie(){
        return $this->id_Movie;
    }
    public function getTitle() {
        return  $this->title;
        }

    public function getOverview() {
        return $this->overview;
         
        }
 
    public function getPoster_Path(){
        return $this->poster_Path;
    }

    public function getBackdrop(){
        return $this->backdrop;
    }

    public function getAdult(){
        return $this->adult;
    }

    public function getLanguage(){
        return $this->language;
    }

    public function getOriginal_Language(){
        return $this->original_language;
    }

    public function getRelease_date(){
        return $this->release_date;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setId_Movie($id_Movie){
        $this->id_Movie = $id_Movie;
    }

    public function setTitle($title){
        $this->title = $title;
    }
  
    public function setOverview($overview){
        $this->overview = $overview;
    }

    public function setPoster_Path($poster_Path){
        $this->poster_Path = $poster_Path;
    }

    public function setBackdrop($backdrop){
        $this->backdrop = $backdrop;
    }

    public function setAdult($adult){
        $this->adult = $adult;
    }

    public function setLanguage($language){
         $this->language = $language;
    }

    public function setOriginal_Language($original_language){
        $this->original_language = $original_language;
    }

    public function setRelease_date($release_date){
        $this->release_date = $release_date;
    }

    public function setDuration($duration){
        $this->duration = $duration;
    }
}

?>
<?php 

    namespace models;
    class Genre{
        private $genreList;

        public function __construct(){
            $this->genreList = array();
        }

        public function getGenre(){
            return $this->genreList;
            }

        public function setGenre($genreList){
            $this->genreList = $genreList;
        }
       
        public function addGenre($newGenre){
            $this->genreList[] = $newGenre;
        }

        public function searchGenre($newGenre){
            $exist = null;
            foreach($this->genreList as $genre){
                if($newGenre == $genre){
                    $exist = $newGenre;
                }
            }
            return $exist;
        }
    }





?>

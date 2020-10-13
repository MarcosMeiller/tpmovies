<?php 

    namespace models;
    class Genre{
        private $id;
        private $genre;

        public function __construct($id,$genre){
            $this->id = $id;
            $this->genre = $genre;
        }

        public function getGenre(){
            return $this->genre;
        }

        public function getId(){
            return $this->id;
        }
            
        public function setId($id){
            $this->id = $id;
        }
          
        public function setGenre($genreList){
            $this->genre = $genre;
        }

  
    }





?>

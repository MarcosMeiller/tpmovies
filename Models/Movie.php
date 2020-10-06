<?php 

namespace models;

class Movie{
    private $id;
    private $name;
    private $genre;
    private $duration;
    private $direct;
    private $description;
    

    function __construct($id,$name,$genre,$duration,$direct,$description){
        $this->id = $id;
        $this->name = $name;
        $this->genre = $genre;
        $this->duration = $duration;
        $this->direct = $direct;
        $this->description = $description;    
    }

    public function getId($id){
        return $this->id;
    }

    public function getName() {
        return  $this->name;
        }
    public function getGenre() {
        return $this->genre;
        
        }
    public function getDuration() {
        return $this->duration;
          
         }
    public function getDirect() {
        return $this->direct;
         
            }
    public function getDescription() {
        return $this->description;
         
        }
    
    public function setName($name){
        $this->name = $name;
    }
    public function setGenre($genre){
        $this->genre = $genre;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function setDirect($direct){
        $this->direct = $direct;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function setId($id){
        $this->id = $id;
    }
}

?>
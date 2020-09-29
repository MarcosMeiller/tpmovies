<?php 

namespace models;

class Movie{
    private $name;
    private $genre;
    private $duration;
    private $direct;
    private $description;
    

    function __construct($name,$genre,$duration,$direct,$description){
        $this->name = $name;
        $this->genre = $genre;
        $this->duration = $duration;
        $this->direct = $direct;
        $this->description = $description;    
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

}

?>
<?php 

namespace models; 

class cinema{

    $capacity;
    $name;
    $location;

    public function __construct( $capacity,$name,$location){
        $this->capacity = $capacity;
        $this->name = $name;
        $this->location = $location;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getName(){
        return $this->name;
    }
    public function getCapacity(){
        return $this->capacity;
    }
    
    public function setLocation($location){
        $this->location = $location;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }

}






?>
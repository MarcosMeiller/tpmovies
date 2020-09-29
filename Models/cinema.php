<?php 

namespace models; 

class cinema{

    private $capacity;
    private $name;
    private $location;
    private $room;

    public function __construct( $capacity,$name,$location){
        $room = array();
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
<?php 

namespace models; 

class Cinema{

    private $id;
    private $capacity;
    private $name;
    private $location;
    //private $room;

    ///constructor.
    public function __construct($capacity,$name,$location,$id){
       // $room = array();
        $this->id = $id;
        $this->capacity = $capacity;
        $this->name = $name;
        $this->location = $location;
    }
    
    public function getId($id){
        return $this->id;
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

    public function setId($id){
        $this->id = $id;
    }
}






?>
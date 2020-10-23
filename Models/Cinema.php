<?php 

namespace Models; 

class Cinema{

    private $id;
    private $name;
    private $address;
    //private $rooms; ///Si en el futuro se tiene que cambiar a id, se encarga carlos.

    ///constructor.
    public function __construct($name,$address){
        //$this->rooms = $rooms
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;

    }
    
    public function getId(){
        return $this->id;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getName(){
        return $this->name;
    }
    
 
    

    /*public function getRooms(){
        return $this->rooms;
    }

    public function setRooms($rooms){
        $this->rooms = $rooms;
    }*/

    public function setAddress($address){
        $this->address = $address;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
  
    public function setId($id){
        $this->id = $id;
    }

    
  
}






?>
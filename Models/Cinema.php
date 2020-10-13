<?php 

namespace Models; 

class Cinema{

    private $id;
    private $capacity;
    private $name;
    private $address;
    private $priceUnit;
    //private $room;

    ///constructor.
    public function __construct($id,$name,$capacity,$address,$priceUnit){
       // $room = array();
        $this->id = $id;
        $this->capacity = $capacity;
        $this->name = $name;
        $this->address = $address;
        $this->priceUnit = $priceUnit;
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
    
    public function getCapacity(){
        return $this->capacity;
    }
    
    public function getPriceUnit(){
        return $this->priceUnit;
    }

    public function setAddress($address){
        $this->address = $address;
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

    
    public function setpriceUnit($priceUnit){
        $this->priceUnit = $priceUnit;
    }
}






?>
<?php 

    namespace models;
    class Room{
        private $id;
        private $id_Cinema;
        private $name;
        private $capacity;
        private $price;


        public function __construct($capacity,$id_Cinema,$name,$price){
            $this->name = $name;
            $this->capacity = $capacity;
            $this->price = $price;
        }

        public function getCapacity(){
            return $this->Capacity;
        }

        public function getId(){
            return $this->id;
        }

        public function getId_Cinema(){
            return $this->id_Cinema;
        }

        public function getName(){
            return $this->name;
        }
        
        public function getPrice(){
            return $this->price;
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

        public function setId_Cinema($id_Cinema){
            $this->id_Cinema = $id_Cinema;
        }
        
        public function setprice($price){
            $this->price = $price;
        }
    




        }





?>
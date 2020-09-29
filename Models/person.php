<?php 
namespace models;

class Person{
    private $name;
    private $dni;
    private $lastname;
    private $age;

    function __construct($dni,$name,$lastname,$age){
        $this->age = $age;
        $this->dni = $dni;
        $this->lastname = $lastname;
        $this->name = $name;
    }

        public function getName(){
            return  $this->name;
        }
        
        public function getLastName(){
            return $this->lastName;
        }

        public function getDni(){
            return $this->dni;  
        }

        public function getAge(){
            return $this->age
        } 
        
        public function setName($name){
            $this->name = $name;
        }
        
        public function setLastName($lastName){
            $this->lastName = $lastName;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function setAge($age){
            $this->age = $age;
        }


}


?>
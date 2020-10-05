<?php 
    namespace Models;

    class User 
    {
        private $userName;
        private $password;
        private $email;
        private $name;
        private $lastname;


        function __construct($userName,$name,$lastname,$email,$password){
            $this->userName = $userName;
            $this->password = $password;
            $this->lastname = $lastname;
            $this->name = $name;
            $this->email = $email;
        }
        
        public function getUserName(){
            return $this->userName;
        }

        public function getPassword(){
            return $this->password;            
        }

        public function getEmail(){
            return $this->email;
        }
        public function getName(){
            return  $this->name;
        }
        
        public function getLastName(){
            return $this->lastname;
        }
        
        public function setUserName($userName){
            $this->userName= $userName;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setName($name){
            $this->name = $name;
        }
        
        public function setLastName($lastname){
            $this->lastname = $lastname;
        }



    }
?>
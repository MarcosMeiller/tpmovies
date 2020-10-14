<?php 
    namespace Models;

    class User 
    {
        private $id;
        private $userName;
        private $password;
        private $email;
        private $name;
        private $lastname;
        private $id_type;


        function __construct($id,$userName,$name,$lastname,$email,$password){
            $this->id = $id;
            $this->userName = $userName;
            $this->password = $password;
            $this->lastname = $lastname;
            $this->name = $name;
            $this->email = $email;
            $this->id_type = 0;
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
        public function getId(){
            return $this->id;
        }
    
        public function getId_Type(){
            return $this->id;
        }
    
        public function setId_Type($id_type){
            $this->id_type = $id_type;
        }

        public function setId($id){
            $this->id = $id;
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
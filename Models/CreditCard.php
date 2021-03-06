<?php namespace models;

class CreditCard{
    private $id;
    private $id_User;
    private $numberCard;
    private $dateExpired;
    private $codeSecurity;
    private $name;

    public function __construct($id_User,$numberCard, $dateExpired,$codeSecurity,$name){
        $this->id_User = $id_User;
        $this->numberCard = $numberCard;
        $this->dateExpired = $dateExpired;
        $this->codeSecurity = $codeSecurity;
        $this->name = $name;
        
    }

   
    public function getId(){
        return $this->id;
    }
    
    

    public function getNumberCard(){
        return $this->numberCard;  
    }

    public function getid_User(){
        return $this->id_User;
    } 

    public function getName(){
        return $this->name;
    }
    

    public function getDateExpired(){
        return $this->dateExpired;
    }

    public function getCodeSecurity(){
        return $this->codeSecurity;
    }
   
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNumberCard($numberCard){
        $this->numberCard = $numberCard;
    }

    public function setId_User($id_User){
        $this->id_User = $id_User;
    }

    
    public function setDateExpired($dateExpired){
        $this->dateExpired = $dateExpired;
    }

    public function setCodeSecurity($codeSecurity){
        $this->codeSecurity = $codeSecurity;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    

}

?>
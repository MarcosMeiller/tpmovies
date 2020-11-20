<?php namespace models;

class CreditCard{
    private $id;
    private $dni;
    private $id_User;
    private $numberCard;
    private $dateExpired;
    private $codeSecurity;

    public function __construct($dni,$id_User,$numberCard, $dateExpired,$codeSecurity){
        $this->id_User = $id_User;
        $this->numberCard = $numberCard;
        $this->dni = $dni;
        $this->dateExpired = $dateExpired;
        $this->codeSecurity = $codeSecurity;
        
    }

   
    public function getId(){
        return $this->id;
    }
    
    public function getDni(){
        return  $this->dni;
    }

    public function getNumberCard(){
        return $this->numberCard;  
    }

    public function getid_User(){
        return $this->id_User;
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

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function setDateExpired($dateExpired){
        $this->dateExpired = $dateExpired;
    }

    public function setCodeSecurity($codeSecurity){
        $this->codeSecurity = $codeSecurity
    }

}

?>
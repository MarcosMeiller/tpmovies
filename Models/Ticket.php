<?php namespace models;

class Ticket{
    private $id_ticket;
    private $id_Function;
    private $id_User;
    private $seat;

    public function __construct($id_Function,$id_User,$seat){
        $this->id_Function = $id_Function;
        $this->id_User = $id_User;
        $this->seat = $seat;
        
    }

    public function getSeat(){
        return $this->seat;
    }

    public function getId_ticket(){
        return  $this->id_ticket;
    }

    public function getid_Function(){
        return $this->id_Function;  
    }

    public function getid_User(){
        return $this->id_User;
    } 

   
    public function setId_Ticket($id_ticket){
        $this->id_ticket = $id_ticket;
    }
    
    public function setId_Function($id_Function){
        $this->id_Function = $id_Function;
    }

    public function setId_User($id_User){
        $this->id_User = $id_User;
    }

    public function setSeat($seat){
        $this->seat = $seat;
    }


}

?>
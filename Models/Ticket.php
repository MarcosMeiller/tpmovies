<?php namespace models;

class Ticket{
    private $id_ticket;
    private $precio;
    private $id_cine;
    private $id_movie;
    private $date;

    public function __construct($id_ticket,$price,$id_cine,$id_movie,$date){
        $this->id_ticket = $id_ticket;
        $this->price = $price;
        $this->id_cine = $id_cine;
        $this->id_movie = $id_movie;
        $this->date = $date;
    }

    public function getId_ticket(){
        return  $this->id_ticket;
    }
    
    public function getPrice(){
        return $this->price;
    }

    public function getId_cine(){
        return $this->id_cine;  
    }

    public function getId_movie(){
        return $this->id_movie;
    } 

    public function getDate(){
        return $this->date;
    } 
    
    public function Id_ticket($id_ticket){
        $this->id_ticket = $id_ticket;
    }

    public function setPrice($price){
        $this->price = $price;
    }
    
    public function setId_cine($id_cine){
        $this->id_cine = $id_cine;
    }

    public function setId_movie($id_movie){
        $this->id_movie = $id_movie;
    }

    public function setDate($date){
        $this->date = $date;
    }

}

?>
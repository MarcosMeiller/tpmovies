<?php 

    namespace models;
    
    class FunctionCinema{
        private $id;
        private $id_Room;
        private $id_Movie;
        private $date;
        private $hour;

        public function __construct($id_Room,$id_Movie,$date,$hour){
            $this->date = $date;
            $this->hour = $hour;
            $this->id_Room = $id_Room;
            $this->id_Movie = $id_Movie;
        }

        public function getDate(){
            return $this->date;
        }

        public function getHour(){
            return $this->hour;
        }

        public function getId(){
            return $this->id;
        }

        public function getId_Room(){
            return $this->id_Room;
        }

        public function getId_Movie(){
            return $this->id_Movie;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setId_Room($id_Room){
            $this->id_Room = $id_Room;
        }

        public function setId_Movie($id_Movie){
            $this->id_Movie = $id_Movie;
        }

        public function setDate($date){
            $this->date = $date ;
        }

        public function setHour($hour){
            $this->hour = $hour;
        }


    }
        ?>
<?php namespace Models;

class Rol{

    //private $isAdmin;
    /*
    id type
    */

    function __construct($isAdmin){
        $this->isAdmin = $isAdmin;
    }

    public function getIsAdmin(){
        $this->isAdmin;
    }

    public function setIsAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
    }

}

?>
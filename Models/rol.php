<?php namespace Models;

class Rol{

    private $isAdmin;

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
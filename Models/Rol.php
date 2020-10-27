<?php namespace Models;

class Rol{

    private $id;
    private $id_type;
    private $type;

    function __construct($id_type,$type){
        $this->id_type = $id_type;
        $this->type = $type;
    }


    public function getId(){
        return $this->id;
    }
    public function getId_Type(){
        return $this->id_type;
    }
    public function getType(){
        return $this->type;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    public function setId_Type($id_type){
        $this->id_type = $id_type;
    }

    public function setType($type){
        $this->type = $type;
    }

}

?>
<?php 

namespace Controllers;

Use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionDAO as FunctionDAO;

class FunctionController{
    private $dao;

    public function __construct(){
        $this->dao = new FunctionDao();
    }

    public function addFunction($id_Room,$id_movie,$date,$hour){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
             $date = $this->test_input($date);
             $hour = $this->test_input($hour);
            if($date && $hour){
                $actualDate = date("Y-m-d");
                if($date > $actualDate){ 
                    $function = new FunctionCinema($id_Room,$id_movie,$date,$hour);
                    $this->dao->add($function);
                }
                else{
                    $this->function("la fecha actual no esta disponible.");
                }
            }

        }

    }

    public function test_input($data) { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}






}








?>
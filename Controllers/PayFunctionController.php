<?php namespace Controllers;

class PayFunctionController
{
    private $dao;

  

    
    public function PayFunction($message = "", $type="",$id = 0)
    {
        if(!isset($_SESSION["loggedUser"])){
            $_SESSION['msjFunction'] = "Registrese o loguese";
            $_SESSION["bgMsgFunction"] = "Alert";
           
            $_SESSION['msjFunction'] = "Proximamente";
            $_SESSION["bgMsgFunction"] = "Alert";
         
            
        }      
    }        
}


?>
<?php namespace Controllers;

    class MainController
    {

        public static function Index($message = "")
        {
            require_once(VIEWS_PATH."welcome.php");
        } 
        
        public function Init($message=''){
            header("Location:".FRONT_ROOT);
        }

    }
?>
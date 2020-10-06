<?php namespace Controllers;

    class MainController
    {
        public static function Welcome($message = "")
        {
            require_once(VIEWS_PATH."welcome.php");
        } 
        
        public function Init($message=''){
            header("Location: /tpmovies/");
        }
    }
?>
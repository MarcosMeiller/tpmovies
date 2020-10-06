<?php namespace Controllers;

    class AdminController
    {
        public static function ViewAdmin($message = "")
        {
            require_once(VIEWS_PATH_ADMIN."/index.php");
        } 
        
    }
?>
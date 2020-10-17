<?php namespace Controllers;

    class AdminController
    {
        public static function Index($message = "")
        {  
            if(isset($_SESSION["isAdmin"])){
                if($_SESSION['isAdmin'] == 'admin'){
                    require_once(VIEWS_PATH_ADMIN."/index.php");
                }else{
                    header("Location: /tpmovies/");
                }
              
            }else{
                header("Location: /tpmovies/");
            }
        } 
        
    }
?>
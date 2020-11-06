<?php namespace Controllers;

    class AdminController
    {
        public static function Index($message = "")
        { 
            /* Verifica que la variable session este seteada y que sea 
            admin, luego redirije segun corresponda */ 
            if(isset($_SESSION["isAdmin"])){
                if($_SESSION['isAdmin'] == 'admin'){
                    require_once(VIEWS_PATH_ADMIN."/index.php");
                }else{
                    header("Location: ".FRONT_ROOT);
                }
            }else{
                header("Location: ".FRONT_ROOT);
            }
        } 
        
    }
?>
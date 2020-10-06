<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                
                if(file_exists($classPath)){
    
                    include_once($classPath);
                }
				
			});
        }
    }
?>
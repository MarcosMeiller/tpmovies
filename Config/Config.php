<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
define("FRONT_ROOT","/tpmovies/");
define("VIEWS_PATH","Views/");
define("VIEWS_PATH_ADMIN","Views/admin");
// Coneccion a configuracion base de datos.

define("DB_HOST","localhost");
define("DB_NAME","tpmovies");
define("DB_USER","root");
define("DB_PASS","");
// API TMDB CONFIG
define("API_HOST", 'https://api.themoviedb.org/3');
define("API_KEY", '7897ed3551748666c2c1b414501d5ae4');
define("LANG", 'es-AR');
define("BASE_PATH_IMG", 'https://image.tmdb.org/t/p/');

?>
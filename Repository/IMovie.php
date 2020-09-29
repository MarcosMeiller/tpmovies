<?php 
namespace repository;

use model\movie as movie;

interface IMovie{ 
	function add(movie $newMovie);
	function getAll();
 
}
?>
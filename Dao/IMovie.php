<?php 
namespace Dao;

use model\movie as movie;

interface IMovie{ 
	function add(movie $newMovie);
	function getAll();
	function search($id);
    function delete($code);
}
?>
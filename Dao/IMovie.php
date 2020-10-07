<?php 
namespace Dao;

use model\Movie as Movie;

interface IMovie{ 
	function add(Movie $newMovie);
	function getAll();
	function search($id);
	function delete($code);
	function update(Movie $code)
}
?>
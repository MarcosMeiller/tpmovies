<?php 
namespace Dao;

use models\Movie as Movie;

interface IMovie{ 
	function add(Movie $newMovie);
	function getAll($id);
	function search($id);
	function delete($code);
	function update(Movie $code);
	//function getForGenre($arrayGenre);
}
?>
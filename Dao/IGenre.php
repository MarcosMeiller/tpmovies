<?php 
namespace Dao;

use Models\Genre as Genre;

interface IGenre{ 
	function add(Genre $newGenre);
	function getAll();
	function search($id);
	function delete($code);
 
}
?>
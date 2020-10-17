<?php 
namespace Dao;

use Models\Rol as Rol;

interface IRol{ 
	function add(Rol $newRol);
	function getAll();
	function search($id);

}
?>
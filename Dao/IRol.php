<?php 
namespace Dao;

use model\Rol as Rol;

interface IRol{ 
	function add(Rol $newRol);
	function getAll();
	function search($id);

}
?>
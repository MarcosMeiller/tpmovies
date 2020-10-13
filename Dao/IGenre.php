<?php 
namespace Dao;

use Models\User as User;

interface IUser{ 
	function add(Genre $newUser);
	function getAll();
	function search($email);
	function delete($code);
    function update(Genre $code);
    function getByName($name);
 
}
?>
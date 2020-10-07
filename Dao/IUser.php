<?php 
namespace Dao;

use Models\User as User;

interface IUser{ 
	function add(User $newUser);
	function getAll();
	function search($email);
	function delete($code);
	function update(User $code);
 
}
?>
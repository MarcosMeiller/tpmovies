<?php 
namespace Dao;

use model\cinema as cinema;

interface ICinema{ 
	function add(cinema $newCinema);
    function getAll();
    function search($id);
    function delete($code);
 
}
?>
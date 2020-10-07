<?php 
namespace Dao;

use models\Cinema as Cinema;

interface ICinema{ 
	function add(Cinema $newCinema);
    function getAll();
    function search($id);
    function delete($code);
    function update(Cinema $code)
}
?>
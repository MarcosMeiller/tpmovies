<?php 
namespace Dao;

use models\Room as Room;

interface IRoom{ 
	function add(Room $newRoom);
    function getAll();
    function search($id);
    function delete($code);
    function update(Room $code);
    
}
?>
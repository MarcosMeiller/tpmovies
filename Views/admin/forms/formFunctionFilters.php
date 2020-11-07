<?php namespace views;

if(isset($_SESSION['idroom'])){
    $id= $_SESSION['idroom'];
}else{
    $id = 0;
}

?>

<form name="id_room" method="GET" action="<?php echo FRONT_ROOT ?>Room/RoomsCinema" id="idroom" >
<select required form ="id_room" id="id" name='id' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
onchange="this.form.submit()"
>
    <option value='0'>Todas</option>
    <?php foreach($roomlist as $room){ ?>
        <option value="<?php echo $room->getId() ?>"
        
        <?php $room = $room->getId(); echo ($id == $room ) ? 'selected': '';  ?>

        ><?php echo $room->getName()?> </option>
    <?php } ?>
</select>


</form>

<?php namespace views;

if(isset($_SESSION['idCinema'])){
    $id= $_SESSION['idCinema'];
}else{
    $id = 0;
}

?>

<form name="id_cinema" method="GET" action="<?php echo FRONT_ROOT ?>Room/RoomsCinema" id="id_cinema" >

<select required form ="id_cinema" id="id" name='id' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
onchange="this.form.submit()"
>
    <option value='0'>Todas</option>
    <?php foreach($cinemasList as $cinema){ ?>
        <option value="<?php echo $cinema->getId() ?>"
        
        <?php $idCinema = $cinema->getId(); echo ($id == $idCinema ) ? 'selected': '';  ?>

        ><?php echo $cinema->getName()?> </option>
    <?php } ?>
</select>


</form>

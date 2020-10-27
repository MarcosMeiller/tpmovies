<?php namespace views;

?>

<form name="id_cinema" method="POST" action="<?php echo FRONT_ROOT ?>Room/getRoomByCinema" id="id_cinema" >

<select requerid form ="id_cinema" id="id" name='id' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
onchange="this.form.submit()"
>
    <option value='TODOS'>Todas</option>
    <?php foreach($cinemasList as $cinema){ ?>
        <option value="<?php echo $cinema->getId() ?>"
        
        <?php //$idCinema = $cinema->getId(); echo ($id == $idCinema ) ? 'selected': '';  ?>

        ><?php echo $cinema->getName()?> </option>
    <?php } ?>
</select>


</form>

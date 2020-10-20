<?php namespace views;

?>

<form name="idmovie" method="POST" action="<?php echo FRONT_ROOT ?>Movie/MoviesNowPByGenre" id="idmovie" >

<select requerid form ="idmovie" id="idmovie" name='idmovie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
onchange="this.form.submit()"
>
    <option value='TODAS'>Todas</option>
    <?php foreach($genresList as $genre){ ?>
        <option value="<?php echo $genre->getId() ?>"
        
        <?php $idGenre = $genre->getId(); echo ($id == $idGenre ) ? 'selected': '';  ?>

        ><?php echo $genre->getName()?> </option>
    <?php } ?>
</select>


</form>

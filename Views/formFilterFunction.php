<?php namespace views;
//onchange="this.form.submit()"
if(isset($_SESSION['idgenre'])){
    $id= $_SESSION['idgenre'];
}
else{
    $id = 0;
}
?>


<form name="idgenre" method="GET" action="<?php echo FRONT_ROOT ?>Showtimes/genreFilter" id="idgenre" >
<div class='flex mt-2 md:mt-0'>
<select required form ="idgenre" id="idgenre" name='idgenre' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"

>
    <option value='TODAS'>Todas</option>
    <?php foreach($genresList as $genre){ ?>
        <option value="<?php echo $genre->getId(); ?>"
        
        <?php $idGenre = $genre->getId(); echo ($id == $idGenre ) ? 'selected': '';  ?>

        ><?php echo $genre->getName()?> </option>
    <?php } ?>
</select>

<button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
        <p class="text-sm text-white ">Filtrar</p>
    </button>
</div>
</form>



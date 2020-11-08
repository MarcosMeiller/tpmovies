<?php namespace views;

$hoy = date('Y-m-d');

if(isset($_SESSION['date'])){
    $date = $_SESSION['date'];
}else{
    $date = $hoy;
}


?>

<form name="date" method="GET" action="<?php echo FRONT_ROOT ?>Showtimes/dateFilter" id="date" >

<div class="flex ">
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date" name='date' type="date" value="<?php echo $date; ?>"
       min="<?php echo $hoy; ?>" max="2030-12-31" required />


       <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
        <p class="text-sm text-white ">Filtrar</p>
    </button>
</div>


</form>

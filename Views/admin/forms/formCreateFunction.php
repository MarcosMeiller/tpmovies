<?php namespace forms;

$hoy = date('Y-m-d');


?>

<form class="w-2/3 mb-5 " action='<?php echo FRONT_ROOT ?>Function/addFunction' method='POST'>


  <div class="flex flex-wrap mt-2 justify-center">
  
  <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
  
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_room">
      Sala
    </label>
   
    <select requerid id="id_room" name='id_room' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option value=''>Seleccione una sala</option>
      <?php foreach($roomList as $room){ ?>
          <?php  foreach($cinemaList as $cinema){ 
            if($cinema->getId() == $room->getId_Cinema()){ ?>
                <option value="<?php echo $room->getId() ?>">
                <?php echo $room->getName() ," Del Cine ", $cinema->getName();?>
          <?php }}?>
           
          
          </option>
      <?php } ?>
    </select>
     
  </div>
  

  <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
        Pelicula
      </label>
      
      <select requerid id="id_movie" name='id_movie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
    <option value=''>Seleccione una pelicula</option>
    <?php foreach($adminmovies as $movie){ ?>
        <option value="<?php  echo $movie->getId() ?>">
        <?php echo $movie->getTitle()?> 
        </option>
    <?php } ?>
    </select>
  
      
  </div>
  
  

    <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date">
          Dia
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date" name='date' type="date" placeholder="" value="<?php echo $hoy ?>"
       min="<?php echo $hoy ?>" max="2030-12-31" requerid>
      </div>

      <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="hour">
          Hora
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="hour" name='hour' type="time" placeholder="Ingrese una hora">
      </div>

    <div class="w-full px-3 md:w-full mb-6 md:mb-0 md:mt-6">

      <button class="w-full text-blue-700 font-semibold pb-2 px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
          <p class="mt-2 text-sm text-white ">Agregar</p>
      </button>
    </div>

    
  </div>
</form>

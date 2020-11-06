<?php namespace forms ?>
<form class="w-full max-w-6/12 mb-5 mt-5" action='<?php echo FRONT_ROOT ?>Function/updateFunction' method='post'>
    <!-- nombre y capacidad -->
  <div class="flex flex-wrap ">
    <div hidden class="w-full md:w-full px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id">
        ID
      </label>
      <input value = '<?php echo $id ?>' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="upd_id" type="number" name='id' placeholder="">
      
    </div>
    
    <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
    
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_room">
      Sala
    </label>
   
    <select requerid id="upd_idroom" name='id_room' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
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
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_movie">
        Pelicula
      </label>
      
      <select requerid id="upd_idmovie" name='id_movie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
    <option value=''>Seleccione una pelicula</option>
    <?php foreach($adminmovies as $movie){ ?>
        <option value="<?php  echo $movie->getId() ?>">
        <?php echo $movie->getTitle()?> 
        </option>
    <?php } ?>
    </select>
  
      
  </div>


  </div>

  <div class="flex flex-wrap mt-2">

  <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date">
          Dia
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_date" name='date' type="date" placeholder="" value="<?php echo $hoy ?>"
       min="<?php echo $hoy ?>" max="2030-12-31" requerid>
      </div>

      <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="hour">
          Hora
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_hour" name='hour' type="time" placeholder="Ingrese la precio">
    </div>    


      

  </div>

  <div class="flex flex-wrap ">
  <div class="w-full px-3 mb-6 md:mb-0">
    <button class="w-full bg-white text-blue-700 font-semibold py-3 px-3 mt-5 border-2 border-blue-500 rounded-lg shadow-lg      hover:shadow-xl hover:bg-gray-300 flex items-center justify-center" type="submit">
        <p class="">Actualizar</p>
    </button>
    </div>
  </div>

</form>

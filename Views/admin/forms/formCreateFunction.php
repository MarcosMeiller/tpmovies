<?php namespace forms;

$hoy = date('Y-m-d');


?>
<form class="w-2/3 mb-5 " action='<?php echo FRONT_ROOT ?>Room/addRoom' method='POST'>

  <div class="flex flex-wrap mt-2 justify-center">
  
  <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
  
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
      Cine
    </label>

    <select requerid id="id_Cinema" name='id_Cinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option value=''>Seleccione un cine</option>
      <?php foreach($cinemasList as $cinema){ ?>
          <option value="<?php echo $cinema->getId() ?>">
          <?php echo $cinema->getName()?> 
          </option>
      <?php } ?>
    </select>
     
  </div>
  

  <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
        Sala
      </label>
      
      <select requerid id="id_Cinema" name='id_Cinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
    <option value=''>Seleccione un cine</option>
    <?php foreach($cinemasList as $cinema){ ?>
        <option value="<?php echo $cinema->getId() ?>">
        <?php echo $cinema->getName()?> 
        </option>
    <?php } ?>
    </select>
  
      
  </div>
  
  

    <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="capacity">
          Dia
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="capacity" name='capacity' type="date" placeholder="" value="<?php echo $hoy ?>"
       min="<?php echo $hoy ?>" max="2030-12-31" requerid>
      </div>

      <div class="w-full px-3 md:w-3/6 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
          Hora
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" name='price' type="time" placeholder="Ingrese la precio">
      </div>

    <div class="w-full px-3 md:w-full mb-6 md:mb-0 md:mt-6">

      <button class="w-full text-blue-700 font-semibold pb-2 px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
          <p class="mt-2 text-sm text-white ">Agregar</p>
      </button>
    </div>

    
  </div>
</form>

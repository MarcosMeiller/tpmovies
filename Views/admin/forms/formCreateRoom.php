<?php namespace forms ;

if($cinemasList != []){
  $exists = true;
}else{
  $exists = false;
}

?> 


<div>

  <div class='<?php echo $exists ? "hidden" : "block text-center w-full" ?> '>
    <p class="text-red-500 ">Se deben crear primero cines para poder crear salas.</p>
  </div>

  <form class="w-full mb-5" action='<?php echo FRONT_ROOT ?>Room/addRoom' method='POST'>

    <div class="flex flex-wrap mt-2 justify-center">
    
  

    <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
    
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Cine
        </label>


    <select required id="id_Cinema" name='id_Cinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
  >
      <option value=''>Seleccione un cine</option>
      <?php foreach($cinemasList as $cinema){ ?>
          <option value="<?php echo $cinema->getId() ?>"
        

          ><?php echo $cinema->getName()?> </option>
      <?php } ?>
  </select>
    
      <!--
    <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="id_Cinema" type="number" name='id_Cinema' placeholder="Ingrese nombre del cine" required maxlength='25'>
      -->
      
    </div>
    


    <!-- name -->
    <div class="w-full md:w-2/6 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Nombre Sala
        </label>
        <input required class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" name='name' placeholder="Ingrese nombre del cine" required maxlength='25'>
        
      </div>
    <!-- capacity -->
      <div class="w-full px-3 md:w-2/6">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="capacity">
          Capacity
        </label>
        <input required class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="capacity" name='capacity' type="number" placeholder="Ingrese la capacidad de la sala">
      </div>

      <div class="w-full px-3 md:w-2/6">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
          Price
        </label>
        <input required class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" name='price' type="number" placeholder="Ingrese la precio">
      </div>

    <div class="w-full px-3 md:w-1/6 mb-6 md:mb-0 md:mt-6">

<?php if($exists){ ?>
      <button  class="w-full text-blue-700 font-semibold pb-2 px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
          <p class="mt-2 text-sm text-white ">Agregar</p>
      </button>
<?php }else{ ?>
      <button  class="cursor-not-allowed opacity-50 w-full text-blue-700 font-semibold pb-2 px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="button">
          <p class="mt-2 text-sm text-white ">Agregar</p>
      </button>
<?php }  ?>

      </div>

    </div>
  </form>

</div>
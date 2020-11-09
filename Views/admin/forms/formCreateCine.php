<?php namespace forms ?>
<form class="w-full mb-5 " action='<?php echo FRONT_ROOT ?>Cinema/addCinema' method='POST'>

  <div class="flex flex-wrap mt-2">
  
  <!-- name -->
  <div class="w-full md:w-2/6 px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
        Nombre
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" name='name' placeholder="Ingrese nombre del cine"  maxlength='25'>
      
    </div>
  <!-- address -->
    <div class="w-full px-3 md:w-3/6">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
        Direccion
      </label>
      <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" name='address' type="text" placeholder="Ingrese la dirrecion del cine">
    </div>

  <div class="w-full px-3 md:w-1/6 mb-6 md:mb-0 md:mt-6">

    <button class="w-full text-blue-700 font-semibold pb-2 px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
        <p class="mt-2 text-sm text-white ">Agregar</p>
    </button>
    </div>

  </div>
</form>
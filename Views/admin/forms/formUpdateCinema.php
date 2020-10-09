<?php namespace forms ?>
<form class="w-full max-w-6/12 mb-5 mt-5" action='<?php echo FRONT_ROOT ?>Cinema/updateCinema' method='post'>
    <!-- nombre y capacidad -->
  <div class="flex flex-wrap ">
  <div class="w-full md:w-full px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id">
        ID
      </label>
      <input value = '<?php $id ?>' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="upd_id" type="number" name='upd_id' placeholder="">
      
    </div>
    <div class="w-full md:w-3/5 px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
        Nombre
      </label>
      <input value='' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="upd_name" type="text" name='name' placeholder="Ingrese nombre del cine">
      
    </div>
    <div class="w-full md:w-2/5 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-right" for="capacity">
        Capacidad Total
      </label>
      <input value = '' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name='capacity' id="upd_capacity" type="number" placeholder="">
    </div>
  </div>

  <div class="flex flex-wrap mt-2">

    <div class="w-full px-3 md:w-3/4">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="location">
        Direccion
      </label>
      <input value = '' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_address" name='address' type="text" placeholder="Ingrese la dirrecion del cine">
    </div>

    <div class="w-full md:w-1/4 px-2 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-right" for="priceUnit">
        Valor entrada
      </label>
      <input value = '' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_priceUnit" name='priceUnit' type="number" placeholder="$">
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

<?php namespace forms ?>
<form class="w-full max-w-6/12 mb-5 mt-5" action='<?php echo FRONT_ROOT ?>Room/updateRoom' method='post'>
    <!-- nombre y capacidad -->
  <div class="flex flex-wrap ">
    <div hidden class="w-full md:w-full px-3 mb-2 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id">
        ID
      </label>
      <input value = '<?php $id ?>' class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="upd_id" type="number" name='upd_id' placeholder="">
      
    </div>
    
    <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
    
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Cine</label>

        <select required id="upd_idcinema" name='id_Cinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
      >
          <option value=''>Seleccione un cine</option>
          <?php foreach($cinemasList as $cinema){ ?>
              <option value="<?php echo $cinema->getId() ?>">
              <?php echo $cinema->getName()?> 
              </option>
          <?php } ?>
      </select>
    
    
    </div>


    <!-- name -->
        <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Nombre
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="upd_name" type="text" name='name' placeholder="Ingrese nombre del cine" required maxlength='25'>
        
      </div>

  </div>

  <div class="flex flex-wrap mt-2">

       
    <!-- capacity -->
      <div class="w-full px-3 md:w-3/6">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="capacity">
          Capacity
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_capacity" name='capacity' type="number" placeholder="Ingrese la capacidad de la sala">
      </div>

      <div class="w-full px-3 md:w-3/6">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
          Price
        </label>
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="upd_price" name='price' type="number" placeholder="Ingrese la precio">
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

<?php namespace views;

$i = 0 ;
?>


<div class='bgMovie flex flex-col min-h-full' style="background-image: url('../../Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>

<div class='flex bg-blue-900 justify-center my-2'>
<p class='text-lg text-center text-white uppercase font-bold'><?php echo $movie->getTitle(); ?></p>
</div>

<?php foreach($functionsList as $function){
    if($function->getId_Movie() == $movie->getId()){ ?>
            
      <?php foreach($roomList as $room){ 
          if($room->getId() == $function->getId_Room()){ ?>
          
          <?php foreach ($cinemasList as $cinema){ 
            if($cinema->getId() == $room->getId_Cinema()){ ?>
       <div class='flex flex-row ml-10 sm:ml-20 md:ml-40 lg:ml-48 xl:64'>
            <p class="text-left pt-3 pb-2 text-white uppercase font-bold"><?php echo $cinema->getName(); ?></p> <!-- Nombre del cine -->
        </div>
        <div class='flex flex-col mx-2 md:mx-10 items-center'>
          <table class="w-4/5 flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
              <tr class="bg-blue-900 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">Fecha</th>
                <th class="p-3 text-left">Hora</th>
                <th class="p-3 text-left">Sala</th>
                <th class="p-3 text-left">Precio</th>
                <th class="p-3 text-left" width="110px">Entrada</th>
              </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
              <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3"><?php echo $function->getDate(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 truncate"><?php echo $function->getHour(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3"><?php echo $room->getName(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 truncate"><?php echo "$",$room->getPrice(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 text-green-500 hover:text-green-700 hover:font-bold cursor-pointer rounded-br-lg">Adquirir</td>
              </tr>

            </tbody>
          </table>
       </div>         

      




      <?php }}}} ?>

    <?php }} ?>


<style>

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>
   
</div>

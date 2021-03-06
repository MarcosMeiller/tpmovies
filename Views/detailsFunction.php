<?php namespace views;

$i = 0 ;

if(empty($_SESSION["loggedUser"])){
  $_SESSION['url'] = FRONT_ROOT.'Function/DetailsFunction/'.$movie->getId();
}else{
  unset($_SESSION['url']);
}

echo "<script type='text/javascript'>
function soon() {
    toastr.options = {positionClass: 'toast-bottom-right'};toastr.warning('Proximamente', '', {timeOut: 2000});
}

function noticket() {
  toastr.options = {positionClass: 'toast-bottom-right'};toastr.warning('No hay ticket disponible', '', {timeOut: 2000});
}

</script>";

?>


<div class='bgMovie flex flex-col min-h-full' style="background-image: url('https://image.tmdb.org/t/p/w780/<?= $movie->getBackdrop() ?>')">

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
          <table class="w-full md:w-4/5 flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
              <tr class="bg-blue-900 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">Fecha</th>
                <th class="p-3 text-left">Hora Inicio -- Hora Final</th>
                <th class="p-3 text-left">Sala</th>
                <th class="p-3 text-left">Precio</th>
                <th class="p-3 text-left" width="110px">Entrada</th>
              </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
              <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <?php 
               
                  $horafinal = 0;
                      $parts = explode(":", $function->getHour());
                      $horafinal += $parts[2] + ($parts[1]*60 + $movie->getDuration() * 60 )+ $parts[0]*3600;
                      $horafinal = gmdate("H:i:s", $horafinal);
                ?>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3"><?php echo $function->getDate(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 truncate"><?php echo $function->getHour(); echo "--",$horafinal; ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3"><?php echo $room->getName(); ?></td>
                <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 truncate"><?php echo "$",$room->getPrice(); ?></td>
                
                <?php if($ticketsList == []){ 

                    $capacity = $room->getCapacity();
                    $count = 0;
                    foreach($ticketsList as $ticket){
                      if($ticket->getid_Function() == $function->getId()){
                          $count++;
                      }
                     }

                     if($count == $capacity){
                       
                  ?>
                        <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 text-red-500 hover:text-red-700 hover:font-bold cursor-pointer rounded-br-lg">
                        <a onclick = "noticket()">Agotado</a></td>
                      </tr>
                  <?php  }else{ ?>
                   <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 text-green-500 hover:text-green-700 hover:font-bold cursor-pointer rounded-br-lg">
                   <a href="<?php echo FRONT_ROOT ?>PayFunction/SelectSeat/<?php echo $function->getId() ?>">Adquirir</a>
                   </td>
                   </tr>
                   <?php  }
                  ?>

              <?php }else{ ?>
                  <td class="bg-white border-grey-light border hover:bg-gray-100 p-3 text-green-500 hover:text-green-700 hover:font-bold cursor-pointer rounded-br-lg">
                  <a href="<?php echo FRONT_ROOT ?>PayFunction/SelectSeat/<?php echo $function->getId() ?>">Adquirir</a>
                  </td>
                </tr>
              <?php  } ?>

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

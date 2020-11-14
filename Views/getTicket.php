<?php namespace views;

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>



  <?php foreach($roomList as $room){ 
            if($room->getId() == $function->getId_Room()){ 
              $capacity = $room->getCapacity();
              $count = 0;
              foreach($ticketsList as $ticket){
                if($ticket->getid_Function() == $function->getId()){
                    $count++;
                }
              }  
              $cap = $room->getCapacity();
              $available =  $cap - $count;
              $rows = round($cap / 12);
              $rest = fmod($cap,12);
              echo $rest
              ?>
    
  <div class=''>

      <p>TICKET DISPONIBLE: <?php echo $available ?> </p>

      <?php }} ?>
<!--
    <div>
      <div class='text-center'>

          <?php for($i=0;$i< $rest ;$i++){ ?>
          <i class="material-icons text-green-400 cursor-pointer">event_seat</i>
          <?php } ?>   

          <?php for($i=0;$i< $rows ;$i++){ ?>
            <div class=' flex flex-row justify-center'>
              <?php   for($j=0; $j < 13 ;$j++){ if($j == 6){?> 
                <div class='mx-5'> </div>
              <?php }else{?>
                <div class='text-green-400'>
                <i class="material-icons cursor-pointer">event_seat</i>
                </div>     
              <?php }} ?>
            </div>

          <?php } ?>


          
          <div class=' flex flex-row  justify-center mt-5'>
          <p class='uppercase text-sm text-white bg-blue-900 px-32'>Pantalla</p>
          </div>

      </div>

    </div>
-->
  </div>

</div>


<?php namespace views;

$countSeat = 0;
$totalprice = 0;

echo "

"

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
              ?>
    
  <div class=''>

      <p>TICKET DISPONIBLE: <?php echo $available ?> </p>

      <?php }} ?>

    <div>
      <div class='text-center'>

            <div class='flex flex-row justify-center'>
          <?php for($i=0;$i< $rest ;$i++){ ?>
            <div class='<?php if(true){ echo 'text-green-500'; }else{ echo 'text-red-500'; } ?>'>
                <div class='h-6 w-6 absolute'>
                <input type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if(false){ echo 'disabled'; } ?> value=''/>
                </div>
                 
                <i class="material-icons">event_seat</i>

                </div>    
          <?php } ?>   
            </div>

          <?php for($i=0;$i< $rows ;$i++){ ?>
            <div class=' flex flex-row justify-center'>
              <?php   for($j=0; $j < 13 ;$j++){ if($j == 6){?> 
                <div class='mx-5'> </div>
              <?php }else{?>
                <div onclick="check()">
                <div class='h-6 w-6 absolute'>
                <input id='inputSeat' type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if(true){ echo 'disabled'; } ?> value='<?php echo $i ?>'/>
                </div>
                 
                <i id='seat' class="material-icons">event_seat</i>

                </div>     
              <?php }} ?>
            </div>

          <?php } ?>


          
          <div class=' flex flex-row  justify-center mt-5'>
          <p class='uppercase text-sm text-white bg-blue-900 px-32'>Pantalla</p>
          </div>

      </div>

    </div> <!-- END SEATS -->

    <div>
    <p>Cant Asientos seleccionados: <?php echo $countSeat ?></p>
    <p>Total: $<?php echo $totalprice ?></p>
    </div>

  </div> 

</div>


<script>
function check(){
var seatInput = document.getElementById('inputSeat');
var seat = document.getElementById('seat');
seat.classList.toggle('text-blue-500')
console.log(seatInput.value);
}

</script>
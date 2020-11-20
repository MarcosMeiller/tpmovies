<?php namespace views;

$countSeat = 0;
$totalprice = 0;

echo "

";
$letters = range('A', 'Z');


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

              switch ($cap) {
                case ($cap <= 80):
                  $rows = round($cap / 10);
                  $rest = fmod($cap,10);
                    break;
                case ($cap > 80 && $cap <= 150):
                  $rows = round($cap / 12);
                  $rest = fmod($cap,12);
                    break;
                case ($cap > 150 && $cap <= 300):
                  $rows = round($cap / 16);
                  $rest = fmod($cap,16);
                    break;
                case ($cap > 300 && $cap <= 500):
                  $rows = round($cap / 20);
                  $rest = fmod($cap,20);
                    break;
              }
            ?>
             
   
    
  <div class=''>
      <div class='flex text-center my-5 justify-center'>
        <p class='font-bold mr-2'>Tickets disponibles: </p><p><?php echo $available ?></p><p class='font-bold mx-2'>  -  Valor del ticket para esta sala: </p><p>$<?php echo $room->getPrice() ?></p>
      </div>

     
     <?php }} ?>
       
     <div class=' flex flex-row  justify-center mb-5'>
        <p class='uppercase text-white bg-gray-500 px-32 text-xs'>Pantalla</p>
      </div>


    <?php 
    
    switch ($cap) {
      case ($cap <= 80):
        require 'rooms/lessthan80.php';
          break;
      case ($cap > 80 && $cap <= 150):
        require 'rooms/between81and150.php';
          break;
      case ($cap > 150 && $cap <= 300):
          break;
      case ($cap > 300 && $cap <= 500):
          break;
    }
    
    
    
    
    
    ?>

  </div> 

</div>


<script>
function check(){
var seatInput = document.getElementById('inputSeat');
var seat = document.getElementById('seat');

}

</script>
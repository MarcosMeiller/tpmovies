<?php namespace rooms; 

$error = false;

if(isset($_SESSION['cantseats'])){
  if($_SESSION['cantseats'] == 0){
    $error = true;
  }
}

?>

<form action='<?php echo FRONT_ROOT ?>PayFunction/Checkout' method='POST'>
      <div class='text-center'>


      <input type="number" hidden name="idFunction" id="idFunction" value='<?php echo $function->getId() ?>' />

      <input type="number" hidden name="idRoom" id="idRoom" value='<?php echo $function->getId_Room() ?>' />

          <?php $last = 0; for($i=0;$i< $rows ;$i++){ ?>
            <div class=' flex flex-row justify-center'>
              <?php   for($j=0; $j < 11 ;$j++){ 
                
                $occupied = false;
                $aseat =  $letters[$i]."-".$j; 
                if($ticketsList){
                  foreach($ticketsList as $ticket){
                    if($ticket->getid_Function() == $function->getId()){
                      if(trim($ticket->getSeat()) == $aseat){
                        $occupied = true;
                      }
                  }
                  }
                }
                
                ?> 
                <div onclick="check()" class='<?php if(!$occupied){ echo 'text-green-500'; }else{ echo 'text-red-500'; } ?>'>
                <div class='h-6 w-6 absolute'>
                <input name='seats[]' id='inputSeat' type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if($occupied){ echo 'disabled'; } ?> value='<?php echo $letters[$i] ?>-<?php echo $j ?>'/>
                </div>
                 
                <i id='seat' class="material-icons">event_seat</i>

                </div>     
              <?php } $last = $i;  ?>
            </div>

          <?php } ?>            
          
          
          
          <div class='flex flex-row justify-center'>
          <?php for($i=0;$i< $rest ;$i++){ 
            
            $occupied = false;
                $aseat =  $letters[$last+1]."-".$i; 
                
                if($ticketsList){
                  foreach($ticketsList as $ticket){
                    if($ticket->getid_Function() == $function->getId()){
                      if(trim($ticket->getSeat()) == $aseat){
                        $occupied = true;
                      }
                    }
                  }
                }
            
            ?>
            <div class='<?php if(!$occupied){ echo 'text-green-500'; }else{ echo 'text-red-500'; } ?>'>
                <input name='seats[]' type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if($occupied){ echo 'disabled'; } ?> value='<?php echo $letters[$last+1]?>-<?php echo $i ?> '/>
             
                <i class="material-icons">event_seat</i>

                </div>    
          <?php } ?>   
            </div>


      </div>


    <?php if($error){ ?>
      <div class='flex text-center flex-col my-5 justify-center'>
      <p class='text-xs font-bold text-center text-red-500'>* Debes seleccionar al menos un asiento *</p>
        <p class='text-xs italic text-center text-red-500'>Seleccione al menos uno y vuelva a intentarlo.</p>
      </div>
  <?php } ?>

<div class='flex text-center my-5 justify-center'>
    <button type='submit' class='bg-blue-900 w-2/5 rounded-lg my-2 cursor-pointer hover:bg-blue-700'>
        <p class='text-white py-2 uppercase font-bold'>Ver total y pagar</p>
    </button> 
</div>

    </div> <!-- END SEATS -->
    </form>
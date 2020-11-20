<?php namespace rooms; ?>

<form action='<?php echo FRONT_ROOT ?>PayFunction/Checkout' method='POST'>
      <div class='text-center'>



          <?php $last = 0; for($i=0;$i< $rows ;$i++){ ?>
            <div class=' flex flex-row justify-center'>
              <?php   for($j=0; $j < 11 ;$j++){ ?> 
                <div onclick="check()" class='<?php if(true){ echo 'text-green-500'; }else{ echo 'text-red-500'; } ?>'>
                <div class='h-6 w-6 absolute'>
                <input name='seats[]' id='inputSeat' type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if(false){ echo 'disabled'; } ?> value='<?php echo $letters[$i] ?>-<?php echo $j ?>'/>
                </div>
                 
                <i id='seat' class="material-icons">event_seat</i>

                </div>     
              <?php } $last = $i;  ?>
            </div>

          <?php } ?>            
          
          
          
          <div class='flex flex-row justify-center'>
          <?php for($i=0;$i< $rest ;$i++){ ?>
            <div class='<?php if(true){ echo 'text-green-500'; }else{ echo 'text-red-500'; } ?>'>
                <input name='seats[]' type='checkbox'class='border-2 absolute h-2 w-2 cursor-pointer ' <?php if(false){ echo 'disabled'; } ?> value='<?php echo $letters[$last+1]?>-<?php echo $i ?> '/>
             
                <i class="material-icons">event_seat</i>

                </div>    
          <?php } ?>   
            </div>


      </div>

<div class='flex text-center my-5 justify-center'>
    <button type='submit' class='bg-blue-900 w-2/5 rounded-lg my-2 cursor-pointer hover:bg-blue-700'>
        <p class='text-white py-2 uppercase font-bold'>Ver total y pagar</p>
    </button> 
</div>

    </div> <!-- END SEATS -->
    </form>
<?php namespace views;

//require 'formCreditCard.php'

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>

  <div class='flex flex-row justify-center mt-5'>
    <p class=' font-bold text-center'>Total a pagar: $<?php echo $total ?></p>
  </div>

  <form action='<?php echo FRONT_ROOT ?>' method='POST' class="form-container flex justify-center flex-col bg-red-500" act>
        <div class="field-container">
            <label for="name">Nombre Completo</label>
            <input id="name" maxlength="20" type="text">
        </div>
        <div class="field-container">
            <label for="cardnumber">Numero de Tarjeta</label>
            <!--<span id="generatecard">generar aleatorio</span>-->
            <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric">
            <!--<svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
            </svg>-->
        </div>
        <div class="field-container">
            <label for="expirationdate">Fecha venc (mm/yy)</label>
            <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric">
        </div>
        <div class="field-container">
            <label for="securitycode">Codigo de seguridad</label>
            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
        </div>
    </form>  


    <div class='flex text-center my-5 justify-center'>
    <button type='submit' class='bg-blue-900 w-2/5 rounded-lg my-2 cursor-pointer hover:bg-blue-700'>
        <p class='text-white py-2 uppercase font-bold'>Pagar</p>
    </button> 
</div>     

</div>

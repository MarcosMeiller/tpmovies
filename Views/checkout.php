<?php namespace views;

//require 'formCreditCard.php'

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>

  <div class='flex flex-row justify-center mt-5'>
    <p class=' font-bold text-center'>Total a pagar: $<?php echo $total ?></p>
  </div>

  <?php require 'formCreditCard.php' ?>

<!--
  <form action='<?php echo FRONT_ROOT ?>PayFunction/payTicket' method='POST' class="form-container flex justify-center flex-col bg-red-500" act>
        <div class="field-container">
            <label for="name">Nombre Completo</label>
            <input name='name' id="name" maxlength="20" type="text">
        </div>
        <div class="field-container">
            <label for="cardnumber">Numero de Tarjeta</label>
            <input name='cardnumber' id="cardnumber" type="text">

        </div>
        <div class="field-container">
            <label for="expirationdate">Fecha venc (mm/yy)</label>
            <input name='expirationdate' id="expirationdate" type="text">
        </div>
        <div class="field-container">
            <label for="securitycode">Codigo de seguridad</label>
            <input name='securitycode' id="securitycode" type="text">
        </div>

  <div class='flex text-center my-5 justify-center'>
    <button type='submit' class='bg-blue-900 w-2/5 rounded-lg my-2 cursor-pointer hover:bg-blue-700'>
        <p class='text-white py-2 uppercase font-bold'>Pagar</p>
    </button> 
</div>     

    </form>  

-->
  

</div>

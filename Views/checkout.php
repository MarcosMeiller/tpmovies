<?php namespace views;

//require 'formCreditCard.php'

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>

  <div class='flex flex-row justify-center mt-5'>
    <p class=' font-bold text-center'>Total a pagar: $<?php echo $total ?></p>
  </div>

  <?php require 'formCreditCard.php' ?>

</div>

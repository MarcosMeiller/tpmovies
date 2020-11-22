<?php namespace views;

//require 'formCreditCard.php'

if(empty($_SESSION["msjError"])){
 
  $message = "";
}else{
 
  $message = $_SESSION["msjError"];
 

  echo "<script type='text/javascript'>toastr.options = {positionClass: 'toast-top-right'};toastr.warning('".$message."', '', {timeOut: 3000});</script>";
  unset($_SESSION['msjError']);

}

if(!isset($total)){
  $total = $_SESSION['total'];
}

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>

  <div class='flex flex-row justify-center mt-5'>
    <p class=' font-bold text-center'>Total a pagar: $<?php echo $total ?></p>
  </div>

  <?php require 'formCreditCard.php' ?>

</div>

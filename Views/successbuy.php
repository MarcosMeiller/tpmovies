<?php namespace views;

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>


 
  <div class=''>
      <div class='flex text-center my-5 justify-center flex-col items-center'>

        <div class='flex flex-row'>
          <p class='font-bold mx-2 text-xl'>Su pago se ha completado correctamente.</p>
        </div>
        <i class="fas fa-check-circle text-green-500 text-4xl mt-2"></i>

        <div class='flex flex-col mt-2 mx-5'>
          <p class=''>Le enviaremos un email con la informacion correspondiente a:</p>
          <p class=''><?php echo $user->getEmail()?></p>
        </div>
    </div>

    <div class='flex flex-col items-center mt-2 text-center mx-5 mt-5'>

      <a href='<?php echo FRONT_ROOT?>Showtimes/Listing' class="bg-blue-900 text-white text-sm font-bold uppercase px-6 py-2 rounded shadow outline-none focus:outline-none mr-1 mb-1 w-full  md:w-1/2 cursor-pointer hover:bg-blue-700 ">
        Volver a la cartelera
      </a>

      <a href='<?php echo FRONT_ROOT?>Main/Init' class="bg-blue-900 text-white text-sm font-bold uppercase px-6 py-2 rounded shadow outline-none focus:outline-none mr-1 mb-1 w-full  md:w-1/2 cursor-pointer hover:bg-blue-700 mt-2">
        Ir al inicio
      </a>


    </div> 

</div>


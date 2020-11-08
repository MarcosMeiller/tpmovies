<?php namespace views;

?>

<div class='bgMovie flex flex-col min-h-full' style="background-image: url('../Views/img/bg-cinema3.jpg')">

    <?php require 'navbar.php' ?>


<div class='bg-blue-900 my-2 py-2 flex flex-col md:flex-row justify-around items-center'>
  <?php require 'formCalender.php' ?>
  <?php require 'formFilterFunction.php' ?>
</div>
  


<?php if($functionsList) { ?>
    <?php if($moviesList) { ?>
<div class='container max-w-full mx-auto mt-2'>
  <div class='mx-5'>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 lg:gap-4 xl:mx-24">
    <?php foreach($moviesList as $movie){ ?>

      <?php foreach($idsmovies as $idmovie){
            if($movie->getId() == $idmovie){ ?>


      <a href='<?php echo FRONT_ROOT ?>Function/DetailsFunction/<?php echo $movie->getId()?>' class='cursor-pointer'> 
        
                  <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 bg-white">
                    <img class="w-full" src='https://image.tmdb.org/t/p/w300/<?= $movie->getBackdrop() ?>' alt="Sunset in the mountains" />
                    <div class="px-6 py-4">

                      <div class="font-bold text-xl mb-2">
                        <p><?php echo $movie->getTitle(); ?></p>
                      </div>

                      <div class='h-56 overflow'> 
                      <p class="text-grey-darker text-base">
                      <?php echo $movie->getoverview(); ?></p>
                      </p>
                      </div>
                     
                    </div>
                    <div class="px-6 py-4">

                    <?php  foreach($arraygenres as $gsxms){
                       foreach($gsxms as $gxm){
                        if($gxm['idmovie'] == $movie->getId()){
                          foreach($genresList as $genre){
                            if($genre->getId() === $gxm['idgenre']){
                      ?>
                          <span class="bg-gray-400 inline-block bg-grey-lighter rounded-full px-2 py-1 text-sm font-semibold text-grey-darker mr-2 mt-2">
                          <?php echo $genre->getName(); ?>
                          </span>
                      <?php
                          }
                        }
                      }
                    }
                    }
                   
                   ?>

                    </div>
                  </div>
               </a>         
        <?php } ?>

        <?php } ?>

    <?php } ?>


      
     
    </div>
  </div>
</div>

<?php }else{ ?>

<div class='text-center mt-8'>
<p class='text-white md:text-xl font-bold uppercase'> :/ No se encontraron funciones.</p>
<p class='text-white md:text-xl font-bold uppercase'>Prueba con otra fecha</p>

</div>
  
<?php } ?>

<?php }else{ ?>

<div class='text-center mt-8'>
<p class='text-white md:text-xl font-bold uppercase'> :/ No se encontraron funciones.</p>
<p class='text-white md:text-xl font-bold uppercase'>Prueba con otra fecha</p>

</div>
  
<?php } ?>

</div>

<?php namespace views;
 
?>



<div class='bgMovie' style="background-image: url('../Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>

    <?php if($functionsList) { ?>
<div class='container max-w-full mx-auto mt-2'>
  <div class='mx-5'>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 lg:gap-4 xl:mx-24">
    <?php foreach($functionsList as $function){ ?>
      
      <a href='<?php FRONT_ROOT ?>DetailsMovie/<?php echo $function->getId()?>' class='cursor-pointer'> 
        <?php foreach($adminmovies as $movie){
            if($movie->getId() == $function->getId_Movie()){ ?>
                  <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 bg-white">
                    <img class="w-full" src='https://image.tmdb.org/t/p/w300/<?= $movie->getBackdrop() ?>' alt="Sunset in the mountains" />
                    <div class="px-6 py-4">

                      <div class="font-bold text-xl mb-2">
                        <p><?php echo $movie->getTitle(); ?></p>
                      </div>

                      <div class='h-64 overflow'> 
                      <p class="text-grey-darker text-base">
                      <?php echo $movie->getoverview(); ?></p>
                      </p>
                      </div>
                     
                    </div>
                    <div class="px-6 py-4">

                    <?php  
                    
                    $namesGenres = array();
                    $arrayIds = $movie->getGenre_Id();
                    foreach($arrayIds as $id){
                      foreach($genresList as $genre){
                        if($id === $genre->getId()){
                          $namesGenres[] = $genre->getName();
                        }
                      }
                    }
                    ?>
    
                    <?php foreach($namesGenres as $genre){ ?>
                      <p class='text-xs mr-2 text-blue-900'>
                      <?php echo $genre; ?> 
                      </p>
                    <?php }?>

                    <span class="bg-gray-300 inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                    </div>
                  </div>
        <?php }} ?>
      </a>
    <?php } ?>


      
     
    </div>
  </div>
</div>

<?php }else{ ?>

<div class='
text-center mt-8'>
<p>No se encontraron funciones</p>

</div>
    
<?php } ?>

    </div>
</div>

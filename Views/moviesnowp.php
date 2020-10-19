<?php namespace views;

$id = $_SESSION['id'];


?>


<div class='bgMovie' style="background-image: url('Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>

         <h1 class='ml-5 my-2 text-2xl text-center text-blue-800'>Peliculas Actuales</h1>      
       
        <div class="flex flex-grow h-full items-center justify-start bg-gray-200" >

       <div class="my-2 pl-5 ">
          <?php require "formFilter.php" ?>
        </div>
    
        </div>
        


<div class='container max-w-full mx-auto mt-2'>
  <div class='mx-5'>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 lg:gap-4 xl:mx-24">
    <?php foreach($moviesList as $movie){ ?>
      <div class='bg-blue-500 px-2 rounded-lg'>
        <div class='overflow-hidden h-12 my-2'>
        <p class='text-white uppercase font-bold text-center text-md whitespace-normal px-2'><?php echo $movie->getTitle(); ?></p>
        </div>

        <img class="rounded" src='https://image.tmdb.org/t/p/w780/<?= $movie->getPoster_Path() ?>' alt="POSTER <?php echo $movie->getTitle() ?>" />

        <div class='flex  flex-wrap my-2'>

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
                  <p class='text-xs mx-2 text-blue-900'>
                  <?php echo $genre; ?> 
                  </p>
                <?php }?>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>


    
    </div>

</div>


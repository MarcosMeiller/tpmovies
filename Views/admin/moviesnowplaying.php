<?php namespace admin;
require 'Views/head.php'; 
$id = 0;
    if($adminmovies){
        foreach($adminmovies as $movieAdmin){
            foreach($moviesList as $movie){
                if($movie->getId_Movie() == $movieAdmin['id_movie']){
                    echo $movie->getTitle();
                }
            }
           
        }
    }
    
?>



    <div class='flex'>

    <?php require 'aside.php' ?>

    <div class="relative w-full flex flex-col h-screen">

        <?php require 'header.php'; ?>
         
        <h1 class='ml-5 my-2 text-2xl text-center text-blue-800'>Peliculas Actuales</h1>      
       
        <div class="flex flex-grow h-full items-center justify-start bg-gray-200 py-2 pl-5">

          
    
        </div>
        
<?php if($moviesList) { ?>
<div class='container max-w-full mx-auto mt-2'>
  <div class='mx-5'>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 lg:gap-4 xl:mx-24">
    <?php foreach($moviesList as $movie){ ?>
      
      <a href='<?php FRONT_ROOT ?>DetailsMovie/<?php echo $movie->getId_Movie()?>' class='cursor-pointer'> 
      
      <div class='bg-blue-500 px-2 rounded-lg'>

        <div class='flex justify-center overflow-hidden my-2 md:pb-2' style="mix-height: 2rem; max-height: 3rem;">
        <p class='md:mt-2 text-white uppercase text-center text-md whitespace-normal text-sm px-2'><?php echo $movie->getTitle(); ?></p>
        </div>

        <img class="rounded" src='https://image.tmdb.org/t/p/w780/<?= $movie->getPoster_Path() ?>' alt="POSTER <?php echo $movie->getTitle() ?>" />

        <div class='flex flex-wrap my-2 pb-2'>

                <?php  
                /*    
                $namesGenres = array();
                $arrayIds = $movie->getGenre_Id();
                foreach($arrayIds as $id){
                  foreach($genresList as $genre){
                    if($id === $genre->getId()){
                      $namesGenres[] = $genre->getName();
                    }
                  }
                }*/
                ?>

                <?php /*foreach($namesGenres as $genre){ ?>
                  <p class='text-xs mr-2 text-blue-900'>
                  <?php echo $genre; ?> 
                  </p>
                <?php }*/?>
        </div>
      </div>
    <?php } ?>


      </a>
     
    </div>
  </div>
</div>

<?php }else{ ?>

<div class='
text-center mt-8'>
<p>No se encontraron peliculas con este genero.</p>
<p>Prueba filtrando con otro genero.</p>
</div>
</div>
 
<?php } ?>
    </div>



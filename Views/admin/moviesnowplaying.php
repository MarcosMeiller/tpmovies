<?php 
namespace admin;

require 'Views/head.php'; 
$id = 0;
    
?>


<div class='flex'>

    <?php require 'aside.php' ?>

    <div class="relative w-full flex flex-col h-screen">

        <?php require 'header.php'; ?>

         
      <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
   
        <div class='flex items-center row px-6 py-2'>
          <h1 class="text-3xl text-black">Peliculas</h1>
        </div>

<?php if($moviesList) { ?>
  <div class='min-w-full min-h-full w-full '>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 xl:mx-24 mx-5">
   
    <?php foreach($moviesList as $movie){ ?>
      <div class='card rounded-lg bg-pink-500 relative'>
         <div class="info opacity-0 absolute text-center flex flex-col h-full">
            
            <div class='' style="mix-height: 2rem; max-height: 3rem;">
            <p class='mt-2 text-white text-center whitespace-normal text-2xl md:text-lg'><?php echo $movie['title']; ?></p>
            </div>

        <div class='h-40 lg:h-56 mx-2 mt-2 overflow-auto'>
              <p class='text-white text-xl md:text-sm'><?php echo $movie['overview'] ?></p>
              </div>  

            <?php $exists=false;  foreach($adminmovies as $movieAdmin){ 
            if($movie['id'] == $movieAdmin['id_movie']){ $exists=true ?> 
                <div class='flex justify-center py-2'>
                <i class="fas fa-check text-green-400"></i>
                <span class='text-2xl md:text-sm text-white ml-2'>YA ESTA AGREGADA  </span>       
                </div>
   
          <?php } } ?>   
            

              <div class='flex justify-center my-2'>
                <?php if($exists){ ?>
              <a href='<?php echo FRONT_ROOT ?>Movie/deleteMoviexAdmin/<?php echo $movieAdmin['idmoviesxadmin'] ?>' class="bg-red-500 hover:bg-white text-2xl md:text-sm text-white hover:text-red-500 font-bold py-2 px-4 rounded">
              QUITAR
            </a>
            <?php }else{ ?>
              <a href='<?php echo FRONT_ROOT ?>Movie/addMoviexAdmin/<?php echo $movie['id'] ?>' class="bg-green-500 hover:bg-white text-2xl md:text-sm text-white hover:text-green-500 font-bold py-2 px-4 rounded">
              AGREGAR
            </a>
            <?php }?>
              </div>
          

         </div>
           <div class='object-fill'>
            <img class="rounded-lg contain " src='https://image.tmdb.org/t/p/w780/<?= $movie['poster_path'] ?>' alt="POSTER <?php echo $movie['title'] ?>" />
           </div>
          
              

          <!--
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

            

         
-->
        </div>
 
    <?php } ?> 
      
    </div>
  </div>

<?php }else{ ?>

<div class='text-center mt-8'>
  <p>No se encontraron peliculas con este genero.</p>
  <p>Prueba filtrando con otro genero.</p>
</div>


</div>
 
<?php } ?>

    </div>

</div>

<style>

.card {
  transition: 0.4s ease-out;
  /*box-shadow: 0px 7px 10px rgba(0, 0, 0, 0.9);*/
}

.card:hover {
  transform: translateY(5px);
}

.card:hover:before {
  opacity: 1;
}

.card:hover .info {
  opacity: 1;
  transform: translateY(0px);
}

.card:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  height: 100%;
  border-radius: 8px;
  background: rgba(0, 0, 0, 0.8);
  z-index: 2;
  transition: 0.5s;
  opacity: 0;
}


.card .info {
  z-index: 3;
  transform: translateY(30px);
  transition: 0.5s;
}


</style>

<?php require 'Views/footer.php';  ?>

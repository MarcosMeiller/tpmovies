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

      <div class='flex flex-col md:flex-row items-center justify-center md:justify-around my-2'>
        <div class=''>
            <p class='text-xs text-center font-bold mx-5'>Este producto utiliza la API de TMDb pero no está respaldado ni certificado por TMDb</p>
        </div>
        <div class=''>        
          <div class='w-32 h-3 mt-2 md:mt-0'>
          <a href="https://www.themoviedb.org/"> 
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.04 35.4"><defs><style>.cls-1{fill:url(#linear-gradient);}</style><linearGradient id="linear-gradient" y1="17.7" x2="489.04" y2="17.7" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#90cea1"/><stop offset="0.56" stop-color="#3cbec9"/><stop offset="1" stop-color="#00b3e5"/></linearGradient></defs><title>Asset 5</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M293.5,0h8.9l8.75,23.2h.1L320.15,0h8.35L313.9,35.4h-6.25Zm46.6,0h7.8V35.4h-7.8Zm22.2,0h24.05V7.2H370.1v6.6h15.35V21H370.1v7.2h17.15v7.2H362.3Zm55,0H429a33.54,33.54,0,0,1,8.07,1A18.55,18.55,0,0,1,443.75,4a15.1,15.1,0,0,1,4.52,5.53A18.5,18.5,0,0,1,450,17.8a16.91,16.91,0,0,1-1.63,7.58,16.37,16.37,0,0,1-4.37,5.5,19.52,19.52,0,0,1-6.35,3.37A24.59,24.59,0,0,1,430,35.4H417.29Zm7.81,28.2h4a21.57,21.57,0,0,0,5-.55,10.87,10.87,0,0,0,4-1.83,8.69,8.69,0,0,0,2.67-3.34,11.92,11.92,0,0,0,1-5.08,9.87,9.87,0,0,0-1-4.52,9,9,0,0,0-2.62-3.18,11.68,11.68,0,0,0-3.88-1.88,17.43,17.43,0,0,0-4.67-.62h-4.6ZM461.24,0h13.2a34.42,34.42,0,0,1,4.63.32,12.9,12.9,0,0,1,4.17,1.3,7.88,7.88,0,0,1,3,2.73A8.34,8.34,0,0,1,487.39,9a7.42,7.42,0,0,1-1.67,5,9.28,9.28,0,0,1-4.43,2.82v.1a10,10,0,0,1,3.18,1,8.38,8.38,0,0,1,2.45,1.85,7.79,7.79,0,0,1,1.57,2.62,9.16,9.16,0,0,1,.55,3.2,8.52,8.52,0,0,1-1.2,4.68,9.42,9.42,0,0,1-3.1,3,13.38,13.38,0,0,1-4.27,1.65,23.11,23.11,0,0,1-4.73.5h-14.5ZM469,14.15h5.65a8.16,8.16,0,0,0,1.78-.2A4.78,4.78,0,0,0,478,13.3a3.34,3.34,0,0,0,1.13-1.2,3.63,3.63,0,0,0,.42-1.8,3.22,3.22,0,0,0-.47-1.82,3.33,3.33,0,0,0-1.23-1.13,5.77,5.77,0,0,0-1.7-.58,10.79,10.79,0,0,0-1.85-.17H469Zm0,14.65h7a8.91,8.91,0,0,0,1.83-.2,4.78,4.78,0,0,0,1.67-.7,4,4,0,0,0,1.23-1.3,3.71,3.71,0,0,0,.47-2,3.13,3.13,0,0,0-.62-2A4,4,0,0,0,479,21.45,7.83,7.83,0,0,0,477,20.9a15.12,15.12,0,0,0-2.05-.15H469Zm-265,6.53H271a17.66,17.66,0,0,0,17.66-17.66h0A17.67,17.67,0,0,0,271,0H204.06A17.67,17.67,0,0,0,186.4,17.67h0A17.66,17.66,0,0,0,204.06,35.33ZM10.1,6.9H0V0H28V6.9H17.9V35.4H10.1ZM39,0h7.8V13.2H61.9V0h7.8V35.4H61.9V20.1H46.75V35.4H39ZM80.2,0h24V7.2H88v6.6h15.35V21H88v7.2h17.15v7.2h-25Zm55,0H147l8.15,23.1h.1L163.45,0H175.2V35.4h-7.8V8.25h-.1L158,35.4h-5.95l-9-27.15H143V35.4h-7.8Z"/></g></g></svg>
          </a>
         
          </div>
        </div>

       
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

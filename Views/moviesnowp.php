<?php namespace views;

echo $_SESSION['id'];


?>


<div class='bgMovie' style="background-image: url('Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>


        <div class="flex flex-grow h-full items-center justify-start bg-gray-200" >

       <div class="my-2 pl-5 ">

        <form name="genres" method="POST" action="<?php echo FRONT_ROOT ?>Movie/MoviesNowPlaying" id="form_genres" >

            <select id="genresFilter" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>TODOS</option>
                <?php foreach($genresList as $genre){ ?>
                    <option value="<?php $genre->getId() ?>"><?php echo $genre->getName()?> </option>
                <?php } ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>    

           
 <button type="submit" >Filtrar</button>
        </form>


        </div>

    
        </div>
    
    
        <h1 class='ml-5 my-2 text-2xl text-center text-blue-800'>Peliculas Actuales</h1>

<div class='bg-red-500 container max-w-full mx-auto'>
  <div class='bg-pink-200 mx-5'>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-2 sm:gap-1 md:gap-2 lg:gap-4 xl:mx-24">
    <?php foreach($moviesList as $movie){ ?>
      <div class='bg-blue-500 px-2 rounded-lg'>
        <div class='overflow-hidden h-12 mt-2'>
        <p class='uppercase text-gray-900 font-bold text-center text-md whitespace-normal px-2'><?php echo $movie->getTitle(); ?></p>
        </div>
        <div>

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
                  <p><?php echo $genre; ?> </p>
                <?php }?>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>


    
    </div>

</div>


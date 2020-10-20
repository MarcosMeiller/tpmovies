<?php namespace views;

    require 'head.php';

	if(isset($_SESSION['id'])){

		$href = "/MoviesNowPByGenre\/".$_SESSION['id'];
	}else{
		$href = "/MoviesNowPlaying";
	}

?>



  <div class="max-w-3xl flex items-center h-auto lg:h-screen flex-wrap mx-auto mt-24 mb-16 lg:my-0">
       <div class='absolute top-0 flex text-blue-900'>
    <a class="ml-5 mt-2" href="<?php echo FRONT_ROOT ?>Movie<?php echo $href ?>">
	<i class="fas fa-arrow-left text-sm"></i>
        Volver
    </a>
    </div>


	<!--Main Col-->
	<div id="profile" class="text-blue-900 md:text-white w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none mx-6 lg:mx-0 ">
	

		<div class="p-4 md:p-0 md:py-12 md:pl-6 text-center lg:text-left rounded-lg bg-blue-700 md:bg-white">
			<!-- Image for mobile view-->
			<div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-32 w-32 bg-cover bg-center mb-8 ">
            <img class="rounded-lg" src='https://image.tmdb.org/t/p/w780/<?= $movie->getPoster_Path() ?>' alt="POSTER <?php echo $movie->getTitle() ?>" />
            </div>
			
            <div class='py-0 md:py-5 rounded-lg md:rounded-none md:rounded-l-lg bg-white md:bg-blue-700 px-5'>
			<h1 class="text-blue-900 md:text-white text-3xl font-bold pt-8 lg:pt-0"><?php echo $movie->getTitle() ?></h1>

			<p class='text-xs mb-2'><?php echo $movie->getRelease_date() ?></p>

			<div class='mb-5 text-description overflow-hidden'>			
			<p class='text-xs mb-2 italic '><?php echo $movie->getOverview() ?></p>

			</div>

			<p class='text-xs'>Lenguaje Original: <?php echo $movie->getOriginal_Language() ?></p>
			<p class='text-xs'>Traduccion Disponible: <?php echo $movie->getLanguage() ?></p>

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
				<p class='text-xs mr-2'>Genero/s: </p>
				<?php foreach($namesGenres as $genre){ ?>
				<p class='text-xs mr-2'>
				<?php echo $genre; ?> 
				</p>
				<?php }?>

			</div>

			<p class='text-xs '>Publico: <?php echo ($movie->getAdult()) ? ' +18' : ' ATP' ?></p>

			<div class="pt-5 pb-2">
				<button class="text-sm bg-blue-900 hover:bg-white text-white hover:text-blue-900 font-bold py-2 px-4 rounded-full">
				  Ver trailer
				</button> 
			</div>

</div>
		</div>

	</div>
	
	<!--Img Col-->
	<div class="w-full lg:w-2/5">
        <img class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block" src='https://image.tmdb.org/t/p/w780/<?= $movie->getPoster_Path() ?>' alt="POSTER <?php echo $movie->getTitle() ?>" />

	</div>

</div>

<?php require 'footer.php'; ?>
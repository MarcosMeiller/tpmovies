<?php namespace views;
/*
$genresdb = file_get_contents(API_HOST.'/genre/movie/list?api_key='.API_KEY.'&language='.LANG);
$genres = json_decode($genresdb,true,)['genres'];
?>
    <pre>
<?php
    echo json_encode($genres,JSON_PRETTY_PRINT);
    exit;
?>
    </pre>
*/
?>

<div class='bgMovie' style="background-image: url('Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>



        <div class="flex flex-grow container mx-auto px-4 w-full h-full items-center justify-center" >

       <div class="inline-block relative w-64">
            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>TODOS</option>
                <?php foreach($genresList as $genre){ ?>
                    <option><?php echo $genre->getName()?> </option>
                <?php } ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>

    
        </div>
    </div>
</div>

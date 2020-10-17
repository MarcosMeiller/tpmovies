<?php namespace views;

$moviesdb = file_get_contents(API_HOST.'/movie/now_playing?api_key='.API_KEY.'&language='.LANG.'&page=1');
$movies = json_decode($moviesdb,true)['results'];
?>
    <pre>
<?php
    echo json_encode($movies,JSON_PRETTY_PRINT);
    exit;
?>
</pre>


<div class='bgMovie' style="background-image: url('Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>



        <div class="flex flex-grow container mx-auto px-4 w-full h-full items-center justify-center" >

       <div class="inline-block relative w-64">
          <p>CARTELERA</p>
        </div>

    
        </div>
    </div>
</div>

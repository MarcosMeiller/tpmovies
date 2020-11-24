<?php namespace admin;
    require 'Views/head.php';  
    require 'Views/footer.php';

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    $user = $_SESSION['loggedUser'];

    $hoy = date('Y-m-d');

    if(isset($_SESSION['idMovie-Gain'])){   
        $idmovie = $_SESSION['idMovie-Gain'];  
    }

    if(isset($_SESSION['idCinema-Gain'])){
            $idcinema = $_SESSION['idCinema-Gain'];
    }

    if(isset($_SESSION['date1'])){
        $date1 = $_SESSION['date1'];
    }
    if(isset($_SESSION['date2'])){
        $date2 = $_SESSION['date2'];
    }


?>
<div class='flex'>
    <?php require 'aside.php'; ?>
    <div class="w-full flex flex-col h-screen overflow-y-hidden">
    <?php require 'header.php'; ?>

    
    <div class="w-full overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow px-6 pt-2">
            <h1 class="text-3xl text-black pb-2">Ganacias</h1>
    


        <div class='flex flex-col md:flex-row md:mx-8'>

            <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="id_movie">
                    Peliculas
                </label>
                <form action='<?php echo FRONT_ROOT ?>Function/GainFilter' method='GET'>           
                <div class='flex'> 
                    <select required id="idmovie" name='idmovie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value=''>Seleccione una pelicula</option>
                    <?php foreach($adminmovies as $movie){ ?>

                        <option value="<?php  echo $movie->getId() ?>"
                        <?php $idm = $movie->getId(); echo ($idm == $idmovie ) ? 'selected': '';  ?>
                        >
                        <?php ($idm == $idmovie ) && $nameMovie = $movie->getTitle(); ?>
                        <?php echo $movie->getTitle()?> 
                        </option>
                    <?php } ?>
                    </select>  

                    <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
                        <p class="text-sm text-white ">Filtrar</p>
                    </button>
                </div>
                </form>


            </div>

            <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="id_movie">
                    Cines
                </label>
                <form action='<?php echo FRONT_ROOT ?>Function/GainFilter' method='GET'>   
                <div class='flex'>
                    <select required id="idcinema" name='idcinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value=''>Seleccione un cine</option>
                    <?php foreach($cinemasList as $cinema){ ?>
                        <option value="<?php  echo $cinema->getId() ?>"

                        <?php $idc = $cinema->getId(); echo ($idc == $idcinema ) ? 'selected': '';  
                            ($idc == $idcinema ) && $nameCinema = $cinema->getName() ;
                        ?>
                        >
                            <?php echo $cinema->getName(); ?> 
                        </option>
                    <?php } ?>
                    </select>    

                    <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
                        <p class="text-sm text-white ">Filtrar</p>
                    </button>
                </div>
                </form>
            </div>

        </div>

        <div class='flex flex-row justify-center'>

                <div class="w-full md:w-3/4 px-3 mb-2 md:mb-0 mt-5">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold text-center" for="id_movie">
                            Rango Fecha ( desde / hasta )
                        </label>
                    <form name="date" method="GET" action="<?php echo FRONT_ROOT ?>Function/GainFilter" id="date" >

                    <div class="flex flex-col md:flex-row mx-8">
                            <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date1" name='date1' type="date" value="<?php echo $date1; ?>"
                        max="<?php echo $hoy; ?>" required />

                        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-1 px-2 mt-5 md:mt-0 md:ml-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date2" name='date2' type="date" value="<?php echo $date2; ?>"
                        max="<?php echo $hoy; ?>" required />


                        <button class="ml-0 md:ml-2 mt-2 md:mt-0 text-blue-700 font-semibold px-5 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
                            <p class="text-sm text-white ">Filtrar</p>
                        </button>
                    </div>
                    </form>
                </div>


        </div>   

        <div class='flex flex-row justify-center mt-5'>
            <a href="<?php echo FRONT_ROOT ?>Function/Gain" class="ml-0 md:ml-2 mt-2 md:mt-0 text-blue-700 font-semibold px-5 border bg-blue-700  rounded-lg flex items-center justify-center cursor-pointer" type="submit">
                <p class="text-sm text-white ">Limpiar Filtros</p>
            </a>
        </div>

        </div> 

        <div class='flex flex-col mt-8 justify-center '>
            <p class='text-center'>
                <span class='font-bold'>PELICULA:</span> <span class='uppercase italic'><?php echo (isset($nameMovie)) ? $nameMovie : 'TODAS' ?></span> - 
                <span class='font-bold'>CINE:</span> <span class='uppercase italic'><?php echo (isset($nameCinema)) ?  $nameCinema : 'TODOS' ?></span> - 
                <span class='font-bold'>FECHA:</span> <span class='uppercase italic'><?php echo ($date1 != '') ?  $date1." - ".$date2 : 'TODAS' ?></span>
            </p>

            <p class='font-bold text-center mt-2'>TOTAL VENDIDO EN PESOS:</p>
            <p class='font-bold text-center text-4xl'>$<?php echo $totalpesos ?></p>
        </div>

    
            </main>

        </div>
    </div>
</div>

 
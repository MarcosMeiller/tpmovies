<?php namespace admin;
    require 'Views/head.php';  
    require 'Views/footer.php';

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    $user = $_SESSION['loggedUser'];

    if(isset($_SESSION['idMovie-Balance'])){   
        $idmovie = $_SESSION['idMovie-Balance'];  
    }

    if(isset($_SESSION['idCinema-Balance'])){
        $idcinema = $_SESSION['idCinema-Balance'];
    }

    if($idmovie == 0 && $idcinema == 0){
        $show = false;
    }else{
        $show = true;
    }

    $msjVoid = false;
    if($VentasxRoom){

        if($VentasxRoom['cantidad'][0] == 0 && $NovendidasxRoom[0] == 0){
            $show = false;
            $msjVoid = true;
        }else{
            $show = true;
            $msjVoid = false;
        }
    }


    //echo $show;

    /*for($i=0;$i< count($VentasxRoom);$i++){
        echo "Titulo".$VentasxRoom['nombre'][$i];
        echo "Cantidad Vendidad".$VentasxRoom['cantidad'][$i];
        echo "No vendidas".$NovendidasxRoom[$i];
    
    }*/


?>
<div class='flex'>
    <?php require 'aside.php'; ?>
    <div class="w-full flex flex-col h-screen overflow-y-hidden">
    <?php require 'header.php'; ?>
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow px-6 pt-2">
                <h1 class="text-3xl text-black pb-2">Balance</h1>
    

                <div class='flex flex-col md:flex-row mx-8'>

        <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="id_movie">
                Peliculas
            </label>
            <form action='<?php echo FRONT_ROOT ?>Function/BalanceMovies' method='GET'>           
            <div class='flex'> 
                <select required id="idmovie" name='idmovie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value=''>Seleccione una pelicula</option>
                <?php foreach($movielist as $movie){ ?>

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
            <form action='<?php echo FRONT_ROOT ?>Function/BalanceCinemas' method='GET'>   
            <div class='flex'>
                <select required id="idcinema" name='idcinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value=''>Seleccione un cine</option>
                <?php foreach($cinemaList as $cinema){ ?>
                    <option value="<?php  echo $cinema->getId() ?>"

                    <?php $idc = $cinema->getId(); 
                    
                    echo ($idc == $idcinema ) ? 'selected': '';  
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
            <?php if($show){ ?>
                <div class="flex flex-wrap mt-6 justify-center">
                    <div class="w-full lg:w-1/2 pr-0 lg:pr-2 ">

                        <div class="p-6 bg-red">
                            <canvas id="chartOne" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($msjVoid){ ?>
                <div class="flex flex-row mt-6 justify-center ">
                    <p class='font-bold text-xl'>TODAVIA NO HAY TICKET VENDIDOS</p>
                </div>
            <?php } ?>
            </main>
    


        </div>
    </div>
</div>

    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script> 
        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                
                labels: [
                <?php  echo "'".$VentasxRoom['nombre'][0]."'" ?>
                ],
                
                datasets: [{
                    label: 'Vendidas',
                    data: [
                <?php echo $VentasxRoom['cantidad'][0]; ?>

                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
           
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',

                    ],
                    borderWidth: 1
                },{
                    label: 'No Vendidas',
                    data: [
                        <?php echo $NovendidasxRoom[0]; ?>

                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                                 
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }
                
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>

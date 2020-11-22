<?php namespace admin;
    require 'Views/head.php';  
    require 'Views/footer.php';

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    $user = $_SESSION['loggedUser'];


?>
<div class='flex'>
    <?php require 'aside.php'; ?>
    <div class="w-full flex flex-col h-screen overflow-y-hidden">
    <?php require 'header.php'; ?>
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-5">Ganacias</h1>
    
                <!--<div class="flex flex-wrap mt-6">
                    <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-plus mr-3"></i> Monthly Reports
                        </p>
                        <div class="p-6 bg-red">
                            <canvas id="chartOne" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-check mr-3"></i> Resolved Reports
                        </p>
                        <div class="p-6 bg-white">
                            <canvas id="chartTwo" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>-->
    
            </main>
    

        <div class="w-full md:w-3/4 px-3 mb-2 md:mb-0 bg-red-500">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_movie">
                Peliculas
            </label>
            <div class='flex'>            
                <select  id="idmovie" name='id_movie' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value=''>Seleccione una pelicula</option>
                <?php foreach($adminmovies as $movie){ ?>
                    <option value="<?php  echo $movie->getId() ?>">
                    <?php echo $movie->getTitle()?> 
                    </option>
                <?php } ?>
                </select>  

                <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
                    <p class="text-sm text-white ">Filtrar</p>
                </button>
            </div>


        </div>

        <div class="w-full md:w-3/4 px-3 mb-2 md:mb-0 mt-5">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_movie">
                Cines
            </label>
            <div class='flex'>
                <select  id="idcinema" name='id_cinema' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value=''>Seleccione un cine</option>
                <?php foreach($cinemasList as $cinema){ ?>
                    <option value="<?php  echo $cinema->getId() ?>">
                    <?php echo $cinema->getName()?> 
                    </option>
                <?php } ?>
                </select>    

                <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
                    <p class="text-sm text-white ">Filtrar</p>
                </button>
            </div>
        </div>


        <div class="w-full md:w-3/4 px-3 mb-2 md:mb-0 bg-red-500 mt-5">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id_movie">
                Rango Fecha (desde / hasta)
            </label>
<form name="date" method="GET" action="<?php echo FRONT_ROOT ?>Showtimes/dateFilter" id="date" >

<div class="flex ">
        <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date" name='date' type="date" value="<?php echo $date; ?>"
       min="<?php echo $hoy; ?>" max="2030-12-31" required />

       <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date" name='date' type="date" value="<?php echo $date; ?>"
       min="<?php echo $hoy; ?>" max="2030-12-31" required />


       <button class="ml-2 text-blue-700 font-semibold px-3 border bg-blue-700  rounded-lg flex items-center justify-center" type="submit">
        <p class="text-sm text-white ">Filtrar</p>
    </button>
</div>
</form>
</div>

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
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
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

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
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

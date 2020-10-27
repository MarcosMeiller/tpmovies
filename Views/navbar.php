<?php namespace views;

  $type = '';
   //isset
    if(empty($_SESSION["loggedUser"])){
      $user = false;
    }else{
      $user = $_SESSION["loggedUser"];
      if(isset($_SESSION["isAdmin"])){
        $type = $_SESSION["isAdmin"];
      }

    }

    if(isset($_SESSION["isAdmin"])){
      echo $_SESSION["isAdmin"];
    }
  
    echo "<script type='text/javascript'>
      function soon() {
          toastr.options = {positionClass: 'toast-bottom-right'};toastr.warning('Proximamente', '', {timeOut: 2000});
      }
    </script>";

?>


<div class="w-full bg-blue-900">

  <div x-data="{ open: false }" class="flex flex-col max-w-screen px-5 lg:px-10 xl:px-20 py-2 mx-auto lg:items-center lg:justify-between lg:flex-row">

      <div class='flex flex-row items-center justify-between'>  
        <a href="<?php echo FRONT_ROOT?>Main/Init" class="px-2 mr-4 inline-flex items-center">
          <i class="fas fa-film text-white text-xl mr-2"></i>
          <span class="text-xl hover:text-2xl text-white font-bold uppercase tracking-wide">MoviePass</span>
        </a>

        <button class="text-white inline-flex p-3 hover:bg-gray-900 rounded lg:hidden ml-auto hover:text-white outline-none flex " @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
              <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
              <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
<?php if($user){ ?>   
      <nav :class="{'flex': open, 'hidden': !open}" class="text-center flex-col flex-grow hidden  lg:items-center lg:pb-0 lg:flex lg:flex-row">
        <div class='flex-col flex lg:flex-row lg:flex-grow'>
          <a href="<?php echo FRONT_ROOT?>Main/Init" class="px-3 py-2 text-gray-400 items-center justify-center hover:text-white">
            <span>Inicio</span>
          </a>
          <a href="<?php echo FRONT_ROOT?>Movie/MoviesNowPlaying" class="px-3 py-2 text-gray-400 items-center justify-center hover:text-white">
            <span>Peliculas Actuales</span>
          </a>
          <a onclick="soon()" class="px-3 py-2 text-gray-400 items-center justify-center hover:text-white cursor-pointer">
            <span>Cartelara</span>
          </a>

        </div>
<?php } ?>
<?php if($user === false) : ?>

        <div class='flex flex-col lg:justify-end lg:flex-row text-center items-center px-5 lg:px-0 border-0 border-t-2 lg:border-t-0 my-2 mx-8 lg:my-0 lg:mx-0 '>
        
          <a href="<?php echo FRONT_ROOT ?>Register" class="px-3 py-2 lg:py-0 text-gray-400 items-center justify-center hover:text-white lg:border-r-2 lg:mr-2">
            <span>Registrarse</span>
          </a>
          <a href="<?php echo FRONT_ROOT ?>Login" class="px-8 lg:px-5 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-800 hover:bg-white my-2 lg:my-0"><span>Inicia Sesion</span></a>
        </div>

<?php else: ?>

        <div @click.away="open = false" class="hidden lg:flex lg:relative focus:outline-none" x-data="{ open: false }">
          <button @click="open = !open" class="flex flex-row text-gray-900 bg-gray-200 items-center px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:mt-0 md:ml-4  focus:text-gray-900 hover:bg-gray-200 focus:outline-none">
            <span class='uppercase'><?php echo $user->getUserName() ?></span>
            <!--<i x-show="!open"class="fas fa-chevron-down ml-2"></i>
            <i x-show="open" class="fas fa-chevron-up ml-2"></i>-->
            <i class='fas fa-user text-blue-900 ml-2 text-xl'></i>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-12 origin-top-right">

            <div class="w-40 px-2 py-2 bg-blue-900 rounded-md">
                <a href="<?php echo FRONT_ROOT ?>Login/Logout" class="flex flex row items-center rounded-lg bg-transparent hover:text-gray-900 justify-between" href="#">
                    <p class="text-sm text-white hover:text-gray-400">Cerrar Session</p>
                    <i class="fas fa-sign-out-alt text-white hover:text-gray-400"></i>
                </a>
                <?php if($type == 'admin'){ ?>
                <a href="<?php echo FRONT_ROOT ?>Admin" class="mt-2 flex flex row items-center rounded-lg bg-transparent hover:text-gray-900 justify-between" href="#">
                    <p class="text-sm text-white hover:text-gray-400">Panel Admin</p>
                    <i class="fas fa-user-tie text-white mr-1 hover:text-gray-400"></i>
                </a>
                <?php } ?>
            </div>
          </div>
        </div>    

        <div class='flex flex-row justify-center lg:hidden lg:justify-center lg:flex-row text-center items-center px-5 lg:px-0 border-0 border-t-2 lg:border-t-0 my-2 mx-8 lg:my-0 lg:mx-0 '>
        <p class='uppercase text-white pr-2 border-0 border-r-2'><?php echo $user->getUserName() ?></p>
          <a href="<?php echo FRONT_ROOT ?>Login/Logout" class="px-3 py-2 lg:py-0 text-gray-400 items-center justify-center hover:text-white lg:border-r-2 lg:mr-2">
          <span>Cerrar Session</span>
        </a>

      </div>
        
<?php endif; ?> 


    </nav>


</div>

</div>
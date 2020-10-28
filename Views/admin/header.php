<?php namespace admin ?> 
 <!-- Desktop Header -->
        <header class="w-full flex items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end ">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-blue-600 focus:outline-none">
                    <!--<img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">-->
					<i class='fas fa-user-tie text-blue-600 hover:text-blue-900 text-2xl'></i>
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-40 bg-white rounded-lg shadow-lg py-2 mt-16 ">
                    <a href="#" class="block px-4 py-2 hover:text-white text-right hover:bg-blue-900">Mi Cuenta</a>
                    <a href="<?php echo FRONT_ROOT?>Main/Init" class="block px-4 py-2 hover:bg-blue-900 hover:text-white text-right">Salir</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-blue-600 py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-2xl font-semibold uppercase hover:text-gray-300">MoviePass Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="<?php echo FRONT_ROOT ?>Cinema/Cinemas" class="flex items-center  text-white py-2 pl-4 nav-item hover:bg-blue-900">
					<i class="fas fa-film mr-3"></i>
                	Peliculas
                </a>
                <a href="<?php echo FRONT_ROOT ?>Cinema/Cinemas" class="flex items-center text-white py-2 pl-4 nav-item hover:bg-blue-900">
					<i class="fas fa-video mr-3"></i>
                	Cines
                </a>
                <a href="<?php echo FRONT_ROOT ?>Room/Rooms" class="flex items-center text-white py-2 pl-4 nav-item hover:bg-blue-900">
                	<i class="fas fa-person-booth mr-3"></i>
                	Salas
                </a>
                <!--<a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item hover:bg-blue-900">
				<i class="fas fa-ticket-alt mr-3"></i>
                Consultas
                </a>
                <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item hover:bg-blue-900">
				<i class="fas fa-calculator mr-3"></i>
                Totales
                </a>
                <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item hover:bg-blue-900">
                    <i class="fas fa-tablet-alt mr-3"></i>
                </a>
                <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item hover:bg-blue-900">
                    <i class="fas fa-calendar mr-3"></i>
                    
                </a>-->

                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    Mi Cuenta
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Cerrar Sesion
                </a>
				  <button class="w-full bg-white text-blue-700 font-semibold py-2 mt-5 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> Admin
            </button>
            </nav>
         
        </header>
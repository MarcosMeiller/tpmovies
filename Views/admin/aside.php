<?php namespace admin;?> 
    <aside class="relative bg-blue-800 h-screen w-1/5 hidden sm:block shadow-xl">
        <div class="flex items-center h-16 border-b-2 border-gray-500 px-6">
            <a href="<?php echo FRONT_ROOT ?>Admin" class="text-white md:text-md lg:text-xl font-bold hover:text-gray-300">MOVIEPASS Admin</a>
        </div>
        <nav class="text-white text-base font-semibold">
            <a href="<?php echo FRONT_ROOT ?>Cinema/Cinemas" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item hover:bg-blue-900">
                <i class="fas fa-video mr-3"></i>
                Cines
            </a>
            <!--<a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item hover:bg-blue-900">
                <i class="fas fa-ticket-alt mr-3"></i>
                Consultas
            </a>
            <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item hover:bg-blue-900">
                <i class="fas fa-calculator mr-3"></i>
                Totales
            </a>
            <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item hover:bg-blue-900">
                <i class="fas fa-tablet-alt mr-3"></i>
                
            </a>
            <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item hover:bg-blue-900">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
            </a>-->
        </nav>
        <a href="#" class="absolute w-full bg-blue-900 bottom-0 bg-blue-900 text-white flex items-center justify-center py-4">
            <i class="fas fa-plus mr-3"></i>
            <p class='hidden xl:flex'>Agregar admin</p><p class='flex xl:hidden'>Admin</p>
        </a>
    </aside>
<?php namespace views;
    require 'head.php';
?>

<div class='bgMovie' style="background-image: url('../Views/img/bg-cinema3.jpg')">
  <div class='flex flex-col mx-auto min-h-full'>

  <?php require 'nav-session.php'; ?>

      <div class="flex flex-grow container mx-auto px-4 w-full h-full items-center justify-center border-2 border-purple-500">
        
          <div class="w-full md:w-1/2 justify-center items-center">
            <div class=" break-words w-full mb-5 shadow-lg rounded-lg bg-gray-300 border-0">
            
              <div class="flex-auto px-4 lg:px-10 py-10 pt-2">
                <div class="text-gray-500 text-center mb-3 font-bold">
                  <small>Registrate</small>
                </div>
                <form action='<?php echo FRONT_ROOT ?>Register/RegisterUser' method='POST'>
                  <div class="relative w-full mb-3">
                    <label
                      class="block uppercase text-gray-700 text-xs font-bold"
                      for="grid-name"
                      >NOMBRE DE USUARIO</label
                    ><input
                      type="text"
                      name='userName'
                      class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                      placeholder="Ingresa un nombre de usuario"
                      style="transition: all 0.15s ease 0s;"
                      maxlength="10"
                      required 
                      value=""
                    />
                  </div>


                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label
                        class="block uppercase text-gray-700 text-xs font-bold"
                        for="grid-name"
                        >NOMBRE</label
                      ><input
                        type="text"
                        name='name'
                        class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                        placeholder="Ingresa tu primer nombre"
                        style="transition: all 0.15s ease 0s;"
                        required 
                        value=""
                      />

                      </div>
                      <div class="relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label
                        class="block uppercase text-gray-700 text-xs font-bold"
                        for="grid-name"
                        >APELLIDO</label
                      ><input
                        type="text"
                        name='lastname'
                        class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                        placeholder="Ingresa tu apellido"
                        style="transition: all 0.15s ease 0s;"
                        required 
                        value=""
                      />
                    </div>
                  </div>


                  <div class="relative w-full mb-3">
                    <label
                      class="block uppercase text-gray-700 text-xs font-bold"
                      for="grid-password"
                      >Correo Electronico</label
                    ><input
                      type="email"
                      name='email'
                      class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                      placeholder="Ingresa tu email"
                      style="transition: all 0.15s ease 0s;"
                      required 
                      value=""
                    />
                  </div>
                  <div class="relative w-full mb-3">
                    <label
                      class="block uppercase text-gray-700 text-xs font-bold"
                      for="grid-password"
                      >Contraseña</label
                    ><input
                      type="password"
                      name="password"
                      class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                      placeholder="Ingresa la contraseña"
                      style="transition: all 0.15s ease 0s;"
                      required 
                      value=""
                      minlength="6"
                    />
                  </div>

                  <div class="relative w-full mb-3">
                    <label
                      class="block uppercase text-gray-700 text-xs font-bold"
                      for="grid-passwordRepeat"
                      >REPETIR Contraseña</label
                    ><input
                      type="password"
                      name="passwordRepeat"
                      class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                      placeholder="Vuelve a ingresar la contraseña"
                      style="transition: all 0.15s ease 0s;"
                      required 
                      value=""
                      minlength="6"
                    />
                  </div>

                  <div class="text-center mt-6">
                    <button
                      class="bg-blue-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full cursor-pointer"
                      type="submit"
                      style="transition: all 0.15s ease 0s;"
                    >
                      REGISTRATE
                    </button>
                  </div>
                </form>
                  <p class="text-red-600 italic text-center mt-2 text-bold"><?php echo $message ?></p>
              </div>
            </div>

            <div class="flex flex-wrap mx-2 mb-5">
              <div class="w-full text-right">
                <a href="<?php echo FRONT_ROOT ?>Login/ViewLogin" class="text-gray-300 font-bold"
                  ><small>SINO INICIA SESION</small></a
                >
              </div>
            </div>

          </div>
        
      </div>

      <?php require 'footer-session.php';?>

    </div>
</div>
  </body>

</html>
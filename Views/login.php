<?php namespace views;
    require 'head.php';
    
  $bg = $_SESSION['bg'];
    if($bg == 1){
      $bgImg = "background-image: url('Views/img/bg-cinema3.jpg')";
      }else{
        $bgImg = "background-image: url('../Views/img/bg-cinema3.jpg')";
      }


?>

<div class='bgMovie flex flex-col mx-auto min-h-full' style="<?php echo $bgImg ?>">

<?php require 'nav-session.php'; ?>

    <div class="flex flex-grow container mx-auto px-4 w-full h-full items-center justify-center border-purple-500">
      
        <div class="w-full md:w-1/2 justify-center items-center">
          <div class=" break-words w-full mb-5 shadow-lg rounded-lg bg-gray-300 border-0">
            <div class="rounded-t mb-0 px-6">
              <!--
              <div class="text-center mb-3">
              
                <h6 class="text-gray-600 text-sm font-bold">
                  Inicia con 
                </h6>
              </div>
              <div class="btn-wrapper text-center">
                <button
                  class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                  type="button"
                  style="transition: all 0.15s ease 0s;"
                >
                <i class="fab fa-facebook-f"></i>
                <span class='ml-2'>Facebook</span>
                </button>
                
              </div>
              <hr class="mt-6 border-b-1 border-gray-400" />
              -->
            </div> 
          
            <div class="flex-auto px-4 lg:px-10 py-10 pt-5">
              <div class="text-gray-500 text-center mb-3 font-bold">
                <small>Inicia sesion con tu email</small>
              </div>
              <form action='<?php echo FRONT_ROOT ?>Login/LoginUser' method='POST'>
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
                    value=''
                  />
                </div>
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-gray-700 text-xs font-bold"
                    for="grid-password"
                    >Contraseña</label
                  ><input
                    type="password"
                    name='password'
                    class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                    placeholder="Ingresa la contraseña"
                    style="transition: all 0.15s ease 0s;"
                    required
                    value=''
                  />
                </div>
                <!--
                <div>
                  <label class="inline-flex items-center cursor-pointer"
                    ><input
                      id="customCheckLogin"
                      type="checkbox"
                      class="form-checkbox text-gray-800 ml-1 w-5 h-5"
                      style="transition: all 0.15s ease 0s;"
                    /><span class="ml-2 text-sm font-semibold text-gray-700"
                      >Remember me</span
                    ></label
                  >
                </div>
                -->
                <div class="text-center mt-6">
                  <button
                    class="bg-blue-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full cursor-pointer"
                    type="submit"
                    style="transition: all 0.15s ease 0s;"
                  >
                    INICIA SESION
                  </button>
                </div>
                <p class="text-sm text-red-600 italic text-center mt-2 font-bold"><?php echo $message ?></p>
              </form>
            </div>
          </div>
          <div class="flex flex-wrap mt-2 mx-2">
          
            <div class="w-1/2">
              <a href="#pablo" class="text-gray-300"
                ><!--<small>Forgot password?</small>--></a
              >
            </div>
            
            <div class="w-1/2 text-right">
              <a href="<?php echo FRONT_ROOT ?>Register" class="text-gray-300 font-bold cursor-pointer"
                ><small>SINO REGISTRATE</small></a
              >
            </div>
          </div> 
          
        </div>
       
    </div>

    <?php require 'footer-session.php';?>

  
</div>
  </body>

</html>
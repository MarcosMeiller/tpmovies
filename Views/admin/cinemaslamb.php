<?php namespace admin;

if(empty($_SESSION["msjCinemas"])){
 
  $message = "";
}else{
 
  $message = $_SESSION["msjCinemas"];
  $type = $_SESSION["bgMsgCinemas"];
    


  switch($type){
      case "success":     
        echo "<script type='text/javascript'>toastr.options = {positionClass: 'toast-bottom-right'};toastr.success('".$message."', '', {timeOut: 2000});</script>";
        unset($_SESSION['msjCinemas']);
        unset($_SESSION["bgMsgCinemas"]);
      break;
      case "alert": 
        echo "<script type='text/javascript'>toastr.options = {positionClass: 'toast-bottom-right'};toastr.warning('".$message."', '', {timeOut: 2000});</script>";
        $bgColor = "bg-organ-200";
      break;
      case "danger": 
        echo "<script type='text/javascript'>toastr.options = {positionClass: 'toast-bottom-right'};toastr.error('".$message."', '', {timeOut: 2000});</script>";
        $bgColor = "bg-red-500";
      break;
     
    }
  
}

require 'Views/head.php'; 

?> 
<div class='flex'>

<?php require 'aside.php'; ?>

<div class="relative w-full flex flex-col h-screen overflow-y-hidden">

    <?php require 'header.php'; ?>
  

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 pt-2">
              <div class='flex items-center row pb-6'>
  
                <h1 class="text-3xl text-black">ABM Cines</h1>
    
              </div>

                <div class="w-full">
                    <div class='flex justify-between items-center mb-5'>
                    <p class="text-xl flex items-center">
                        <i class="fas fa-video text-blue-900 mr-3"></i> Listado de Cines
                    </p> 
                        <button onclick="viewForm()" class="bg-blue-800 cursor-pointer text-white py-2 px-4 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-600 flex  items-center justify-center">
                            <i class="fas fa-plus mr-3"></i><p class='hidden lg:flex'>Agregar Cine</p><p class='flex lg:hidden'>Cine</p>
                        </button>                    
                    </div>

<div id="formCine"class='hidden items-center justify-center'>
    <?php require 'forms/formCreateCine.php' ?>
</div>

                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-2/5 text-left py-3 px-4 uppercase font-semibold text-sm">Nombre</th>
                                    <th class="w-3/5 text-left py-3 px-4 uppercase font-semibold text-sm">Dirección</th>
                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Editar</th>
                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">

                            <?php if($cinemasList){ ?>

                              <?php foreach($cinemasList as $cinema){
                                ?>
                                <tr>
                                    <td class="w-1/5 text-left py-3 px-4"><?php echo $cinema->getName(); ?></td>
                                    <td class="w-1/5 text-left py-3 px-4">
                                    <?php echo $cinema->getAddress(); ?></td>

                                    <td class="text-center py-3 px-4">
                                    <a 
                                      data-id="<?php echo($cinema->getId()); ?>" 
                                      data-name="<?php echo($cinema->getName()); ?>"
                                      data-address="<?php echo($cinema->getAddress()); ?>"
                                      class="modal-open hover:text-blue-500" href="">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    </td>

                                    <td class="text-center py-3 px-4"><a class="hover:text-blue-500" href="<?php echo FRONT_ROOT?>Cinema/deleteCinema/<?php echo $cinema->getId()?>" name='id' type='submit'><i class="fas fa-trash-alt"></i></a></td>
                                </tr>

                              <?php } ?>
                              <?php }else{ ?>
                                  <div class='flex flex-col justify-center mt-2 items-center'>
                                    <p class='text-md uppercase text-red-500'>Todavia no hay cines cargados.</p>
                                  </div>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <p class="pt-3 text-gray-600">
                      <!--<a class="underline" href="">ERROR:<?php echo $message ?></a>-->
                    </p>
                </div>

            </main>
    
        </div>
       
    </div>
    <?php require 'Views/footer.php';  ?>

<div id='modalUdpCine' class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-6/12 md:max-w-/12 mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Actualizar Datos Cine</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        
        <?php   require 'forms/formUpdateCinema.php' ?>
        

        <!--Footer-->
        <div class="flex justify-end mx-3">
          <button class="modal-close w-full bg-white text-blue-700 font-semibold py-3 px-3 mb-5 border-2 border-blue-500 rounded-lg shadow-lg      hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
        <p class="">Cancelar</p>
    </button>
        </div>
        
      </div>
    </div>
  </div>
  </div>

  </div>

  <script>

var openmodal = document.querySelectorAll('.modal-open')
for (var i = 0; i < openmodal.length; i++) {
openmodal[i].addEventListener('click', function(event){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var capacity = $(this).data('capacity')
    var address = $(this).data('address')
    var priceUnit = $(this).data('price')
    console.log(priceUnit,id,name);
    event.preventDefault()
    passingData(id,name,capacity,address,priceUnit)
    toggleModal()
})
}

const overlay = document.querySelector('.modal-overlay')
overlay.addEventListener('click', toggleModal)

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
closemodal[i].addEventListener('click', toggleModal)
}

document.onkeydown = function(evt) {
evt = evt || window.event
var isEscape = false
if ("key" in evt) {
isEscape = (evt.key === "Escape" || evt.key === "Esc")
} else {
isEscape = (evt.keyCode === 27)
}
if (isEscape && document.body.classList.contains('modal-active')) {
toggleModal()
}
};

function toggleModal() {
console.log("2");
const body = document.querySelector('body')
const modal = document.querySelector('.modal')
modal.classList.toggle('opacity-0')
modal.classList.toggle('pointer-events-none')
body.classList.toggle('modal-active')
}

function passingData(id,name,capacity,address,priceUnit){
    console.log("3");
    $('#upd_id').val(id);
    $('#upd_name').val(name);
    $('#upd_capacity').val(capacity)
    $('#upd_address').val(address);
    $('#upd_priceUnit').val(priceUnit);
}

function viewForm(){
    console.log("viewForm");
    var form = document.getElementById('formCine');
    form.classList.toggle('flex');
    form.classList.toggle('hidden');
};     

</script>
 
<?php namespace views;

?>
    <pre>
<?php
    echo json_encode($functionsList);
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
        <tr>
                                    <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Cine</th>
                                    <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Sala</th>
                                    <th class="w-2/5 text-left py-3 px-4 uppercase font-semibold text-sm">Pelicula</th>
                                    <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Fecha</th>
                                    <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Horario</th>
                                    <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Precio entrada</th>
        </tr>

        <tbody class="text-gray-700">

                            <?php if($functionList){ ?>

                              <?php foreach($functionList as $function){
                                ?>
                                <tr>
                                  <?php foreach($roomList as $room){ 
                                      if($room->getId() == $function->getId_Room()){ ?>
                                      <td class="w-1/5 text-left py-3 px-4"><?php echo $room->getName(); ?></td>
                                  <?php }} ?>

                                  <?php foreach($adminmovies as $movie){ 
                                      if($movie->getId() == $function->getId_Movie()){ ?>
                                      <td class="w-2/5 text-left py-3 px-4"><?php echo $movie->getTitle(); ?></td>
                                  <?php }} ?>
                                   
                                    <td class="w-1/5 text-left py-3 px-4"><?php echo $function->getDate(); ?></td>
                                    <td class="w-1/5 text-left py-3 px-4">
                                    <?php echo $function->getHour(); ?></td>

                                    <td class="text-center py-3 px-4">
                                    <a 
                                      data-id="<?php echo($function->getId()); ?>" 
                                      data-idmovie="<?php echo($function->getId_Movie()); ?>"
                                      data-idroom="<?php echo($function->getId_Room()); ?>"
                                      data-date="<?php echo($function->getDate()); ?>"
                                      data-hour="<?php echo($function->getHour()); ?>"
                                      class="modal-open hover:text-blue-500" href="">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    </td>

                                    <td class="text-center py-3 px-4"><a class="hover:text-blue-500" href="<?php echo FRONT_ROOT?>Function/deleteFunction/<?php echo $function->getId()?>" name='id' type='submit'><i class="fas fa-trash-alt"></i></a></td>
                                </tr>

                              <?php } ?>
                              <?php }else{ ?>
                                  <div class='flex flex-col justify-center my-2 items-center'>
                                    <p class='text-md uppercase text-red-500'>Todavia no hay Funciones cargadas.</p>
                                  </div>
                              <?php } ?>
                            </tbody>


        </div>
    </div>
</div>

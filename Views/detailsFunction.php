<?php namespace views;

$i = 0 ;
?>



<div class='bgMovie' style="background-image: url('../Views/img/bg-cinema3.jpg')">
    <div class='flex flex-col min-h-full'>

    <?php require 'navbar.php' ?>

<p>detalle funcion</p>

<?php foreach($functionsList as $function){
    if($function->getId_Movie() == $movie->getId()){
                                ?>
                                <tr>
                                  <div>
                                  <?php foreach($roomList as $room){ 
                                      if($room->getId() == $function->getId_Room()){ ?>
                                      <td class="w-1/5 text-left py-3 px-4"><?php echo $room->getName(); ?></td>
                                      <?php foreach ($cinemasList as $cinema){ 
                                          if($cinema->getId() == $room->getId_Cinema()){
                                        ?>
                                            <td class="w-1/5 text-left py-3 px-4"><?php echo $cinema->getName(); ?></td>
                                          <td class="w-1/5 text-left py-3 px-4"><?php echo "$",$room->getPrice(); ?></td>
                                  <?php }}}} ?>
                  
                                      </div>
                                  <div> 

                                      <td class="w-2/5 text-left py-3 px-4"><?php echo $movie->getTitle(); ?></td>
     
                                      </div>
                                    <td class="w-1/5 text-left py-3 px-4"><?php echo $function->getDate(); ?></td>
                                    

                                    <td class="w-1/5 text-left py-3 px-4">
                                    <?php echo $function->getHour(); ?></td>
                                    <div>
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
                                      </div>

                                    <td class="text-center py-3 px-4"><a class="hover:text-blue-500" href="<?php echo FRONT_ROOT?>Function/deleteFunction/<?php echo $function->getId()?>" name='id' type='submit'><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                                      <?php }} ?>

    </div>
</div>

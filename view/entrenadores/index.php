<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/entrenador.php");

$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");

$listaClases = $view->getVariable("clases");
//$listaFechas = $view->getVariable("fechas");

?>


<table class="table table-borderless ml-5 mt-5">

            <tr>
                <!-- Títulos de la -->
                <th>
                    IdClase
                </th>
                <th>
                    Rol
                </th>
                <th>
                    Fecha
                </th>
                <th>
                    Descripción
                </th>
            </tr>
          <?php foreach ($listaClases as $clase){
            if ($clase->getAceptar() == 1) {?>
              <tr bgcolor="#96FE6C">
                  <td><?= $clase->getIdClase()?></td>
                  <td><?= $clase->getRol()?></td>
                  <td><?= $clase->getFecha()?></td>
                  <td><?= $clase->getDescripcion();?></td>
                  <td>
                    <a href="index.php?controller=clase&amp;action=aceptarClase&amp;idClase=<?= $clase->getIdClase()?>"><button class='btn btn-yagami'>Aceptar</button></a>
                    <a href="index.php?controller=clase&amp;action=delete&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Cancelar</button></a>
                    <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


                  </td>
              </tr>
          <?php }else{?>
            <tr>
                <td><?= $clase->getIdClase()?></td>
                <td><?= $clase->getRol()?></td>
                <td><?= $clase->getFecha()?></td>
                <td><?= $clase->getDescripcion();?></td>
                <td><?= $clase->getAceptar();?></td>
                <td>
                  <a href="index.php?controller=clase&amp;action=aceptarClase&amp;idClase=<?= $clase->getIdClase()?>"><button class='btn btn-yagami'>Aceptar</button></a>
                  <a href="index.php?controller=clase&amp;action=delete&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Cancelar</button></a>
                  <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


                </td>
            </tr>
        <?php   }?>

          <?php } ?>
        </table>
        <form  action="index.php?controller=clase&amp;action=add" method="POST" class="text-center">
   <input type="submit" value="Añadir clase" class="mt-5 btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>

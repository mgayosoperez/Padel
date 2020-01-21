<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "index");
$entrenadores = $view->getVariable("entrenadores");
$listaMisClasesParticulares = $view->getVariable("misClasesParticulares");
?>


  <table class="table  table-borderless ml-5 mt-5 ">

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaMisClasesParticulares as $clase){
          if($clase->getAceptar() == 1){?>
            <tr bgcolor="#96FE6C">
              <td><?= $clase->getIdClase()?></td>
              <td><?= $clase->getFecha()?></td>
              <td><?= $clase->getLogin()?></td>
              <td>
                <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Desinscribir</button></a>
              </td>

          </tr>
        <?php }else{?>
          <tr>
            <td><?= $clase->getIdClase()?></td>
            <td><?= $clase->getFecha()?></td>
            <td><?= $clase->getLogin()?></td>
            <td>
              <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Desinscribir</button></a>
            </td>

        </tr>
      <?php  }
      } ?>
      </table>
      <table class="table  table-borderless ml-5 mt-5 ">
        <tr>
          <th>Entrenadores</th>
        </tr>
        <tr>
          <?php foreach ($entrenadores as $entrenador) {?>

              <td>
                <?php echo $entrenador->getLogin() ?><br>
                <a href="index.php?controller=clase&amp;action=inscribirseParticular&amp;entrenador=<?php echo $entrenador->getLogin() ?>"><button class='btn btn-yagami'>Crear Particular</button></a>
              </td>

        <?php } ?>
        </tr>

      </table>

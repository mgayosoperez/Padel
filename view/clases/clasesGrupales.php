<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();


$view->setVariable("title", "index");
$listaClasesGrupales = $view->getVariable("clasesGrupales");
$listaMisClasesGrupales = $view->getVariable("misclasesGrupales");

?>

  <table class="table table-borderless ml-5 mt-5">

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  Maximo de Alumnos
              </th>
              <th>
                  Descripcion
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaClasesGrupales as $clase){
                if (in_array($clase->getIdClase(), $listaMisClasesGrupales)) {?>
                  <tr>
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getMaxAlum()?></td>
                    <td><?= $clase->getDescripcion()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>

                    <td>
                      <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>"><button class='btn btn-yagami'>Desinscribir</button></a>
                    </td>
                </tr>
          <?php }else{?>
                    <tr>

        <td><?= $clase->getIdClase()?></td>
        <td><?= $clase->getMaxAlum()?></td>
        <td><?= $clase->getDescripcion()?></td>
        <td><?= $clase->getFecha()?></td>
        <td><?= $clase->getLogin()?></td>

        <td>
          <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>"><button class='btn btn-yagami'>Inscribirse</button></a>
        </td>
    </tr>
    <?php }?>
  <?php  } ?>
      </table>

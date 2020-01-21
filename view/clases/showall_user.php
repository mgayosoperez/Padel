<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "index");
$listaClasesGrupales = $view->getVariable("clasesGrupales");
$listaClasesParticulares = $view->getVariable("clasesParticulares");
$listaMisClasesGrupales = $view->getVariable("misclasesGrupales");
$listaMisClasesParticulares = $view->getVariable("misClasesParticulares");
?>




<h1>Clases Grupales</h1>

  <table class="table" border=1>

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
                  <tr bgcolor="#FF0000">
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getMaxAlum()?></td>
                    <td><?= $clase->getDescripcion()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>

                    <td>
                      <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>">Desinscribirse</a> </button>
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
          <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
        </td>
    </tr>
    <?php }?>
  <?php  } ?>
      </table>



      <h1>Clases Particulares</h1>

        <table class="table" border=1>

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
              <?php foreach ($listaClasesParticulares as $clase){
                if(in_array($clase->getIdClase(), $listaMisClasesParticulares)){?>
                  <tr bgcolor="#FF0000">
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>
                    <td>
                      <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>">Desinscribirse</a> </button>
                    </td>

                </tr>
              <?php }else {?>
                <tr>
                  <td><?= $clase->getIdClase()?></td>
                  <td><?= $clase->getFecha()?></td>
                  <td><?= $clase->getLogin()?></td>
                  <td>
                    <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
                  </td>
            <?php  }
            } ?>
            </table>

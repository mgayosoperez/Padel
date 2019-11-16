<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$listaClases = $view->getVariable("clases");
$errors = $view->getVariable("errors");
?>

  <table class="table" border=1>

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  MaxAlum
              </th>
              <th>
                  Reserva
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaClases as $clase){?>
          <tr>
              <td><?= $clase->getIdClase()?></td>
              <td><?= $clase->getMaxAlum()?></td>
              <td><?= $clase->getReserva()?></td>
              <td><?= $clase->getLogin()?></td>
              <td>
                <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
              </td>

          </tr>
        <?php } ?>
      </table>

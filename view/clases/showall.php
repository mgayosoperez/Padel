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
                  Rol
              </th>
              <th>
                  Reserva
              </th>
              <th>
                  Entrenador
              </th>
              <th>
                  <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=add">Añadir</a> </button>
              </th>
          </tr>
        <?php foreach ($listaClases as $clase){?>
          <tr>
              <td><?= $clase->getIdClase()?></td>
              <td><?= $clase->getRol()?></td>
              <td><?= $clase->getReserva()?></td>
              <td><?= $clase->getLogin()?></td>
              <td>
                <button type="button" name="button"><a href="index.php?controller=clase&amp;action=delete&amp;idClase=<?= $clase->getIdClase()?>">Borrar</a></button>
                <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


              </td>
          </tr>
        <?php } ?>
      </table>

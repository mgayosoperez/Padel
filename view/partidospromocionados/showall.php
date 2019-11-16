<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$listaPartidos = $view->getVariable("partidos");
$errors = $view->getVariable("errors");
?>

  <table class="table" border=1>

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdPromocionado
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Reserva
              </th>
              <th>
                  Numero Deportistas
              </th>
              <th>
                  <button type="button" class="btn"> <a href="index.php?controller=partidopromocionado&amp;action=add">Añadir</a> </button>
              </th>

          </tr>
        <?php foreach ($listaPartidos as $partido){?>
          <tr>
              <td><?= $partido->getIdPromocionado()?></td>
              <td><?= $partido->getFecha()?></td>
              <td><?= $partido->getReserva()?></td>
              <td><?= $partido->getNumDeportista()?></td>
              <td><!--OjO BOTONES-->
                <button type="button" name="button"><a href="index.php?controller=partidopromocionado&amp;action=delete&amp;idPromocionado=<?= $partido->getIdPromocionado()?>">Borrar</a></button>
              </td>

          </tr>
        <?php } ?>
      </table>

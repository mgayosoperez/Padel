<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$listaEntrenadores = $view->getVariable("entrenadores");
$errors = $view->getVariable("errors");
?>

  <table class="table" border=1>

          <tr>
              <!-- Títulos de la -->
              <th>
                  Login
              </th>
              <th>
                  Password
              </th>
              <th>
                  Dni
              </th>
              <th>
                  NSS
              </th>
              <th>
                  Nombre
              </th>
              <th>
                  Apellidos
              </th>
              <th>
                  Sexo
              </th>
              <th>
                  <button type="button" class="btn"> <a href="index.php?controller=entrenador&amp;action=add">Añadir</a> </button>
              </th>
              <th>
                  <button type="button" class="btn"> <a href="index.php?controller=entrenador&amp;action=add">Buscar</a> </button>
              </th>
          </tr>
        <?php foreach ($listaEntrenadores as $entrenador){?>
          <tr>
              <td><?= $entrenador->getLogin()?></td>
              <td><?= $entrenador->getPasswd()?></td>
              <td><?= $entrenador->getDni()?></td>
              <td><?= $entrenador->getNss()?></td>
              <td><?= $entrenador->getNombre()?></td>
              <td><?= $entrenador->getApellidos()?></td>
              <td><?= $entrenador->getSexo()?></td>
              <td><!--OjO BOTONES-->
                <button type="button" name="button"><a href="index.php?controller=entrenador&amp;action=update&amp;login=<?=$entrenador->getLogin()?>">Editar</a></button>

              </td>
              <td>
                <button type="button" name="button"><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a></button>
                <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


              </td>
          </tr>
        <?php } ?>
      </table>

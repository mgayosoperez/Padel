<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");
require_once(__DIR__."/../../view/navBar/admin.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$listaEntrenadores = $view->getVariable("entrenadores");


?>





  <table class="table table-borderless ml-5 mt-5">
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
                <a href="index.php?controller=entrenador&amp;action=update&amp;login=<?=$entrenador->getLogin()?>"><button class='btn btn-yagami'>Editar</button></a>

              </td>
              <td>
                <a href="index.php?controller=entrenador&amp;action=delete&amp;username=<?=$entrenador->getLogin()?>"><button class='btn btn-yagami'>Borrar</button></a>
                <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


              </td>
          </tr>
        <?php } ?>
      </table>

<form  action="index.php?controller=entrenador&amp;action=add" method="POST" class="text-center">
   <input type="submit" value="Añadir entrenador" class="mt-5 btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>

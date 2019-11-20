<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");

$listaClases = $view->getVariable("clases");
//$listaFechas = $view->getVariable("fechas");

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=clase&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=entrenador&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

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
          <?php foreach ($listaClases as $clase){?>
            <tr>
                <td><?= $clase->getIdClase()?></td>
                <td><?= $clase->getRol()?></td>
                <td><?= $clase->getFecha()?></td>
                <td><?= $clase->getDescripcion();?></td>
                <td>
                  <a href="index.php?controller=clase&amp;action=delete&amp;idClase=<?= $clase->getIdClase()?>"><button class='btn btn-yagami'>Borrar</button></a>
                  <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


                </td>
            </tr>
          <?php } ?>
        </table>
        <form  action="index.php?controller=clase&amp;action=add" method="POST" class="text-center">
   <input type="submit" value="Añadir clase" class="mt-5 btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>


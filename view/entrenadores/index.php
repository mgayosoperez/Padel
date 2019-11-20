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
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Clases
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=add">Crear mis clases</a>
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=showClases">Ver mis clases</a>
        </div>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=entrenador&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


<table class="table">

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
                <th>
                    <a href="index.php?controller=clase&amp;action=add"><button class='btn'>Añadir</button></a>
                </th>
            </tr>
          <?php foreach ($listaClases as $clase){?>
            <tr>
                <td><?= $clase->getIdClase()?></td>
                <td><?= $clase->getRol()?></td>
                <td><?= $clase->getFecha()?></td>
                <td><?= $clase->getDescripcion();?></td>
                <td>
                  <a href="index.php?controller=clase&amp;action=delete&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Borrar</button></a>
                  <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


                </td>
            </tr>
          <?php } ?>
        </table>

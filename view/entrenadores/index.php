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

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=partidoPromocionado">Partidos Promocionados<span class="sr-only"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=campeonatos">Campeonatos</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=admin&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


<div class="container">
  <h2>Carousel Example</h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
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

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

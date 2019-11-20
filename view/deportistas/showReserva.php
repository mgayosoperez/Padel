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
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=deportista&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reservas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=reserva">Crear reserva</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showReservas">Ver reservas</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showPromocionados">Partidos Promocionados</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=deportista&amp;action=campeonatos">Campeonatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesGrupales">Clases Grupales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesParticulares">Clases Particulares</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

<?php if(isset($datos)){
  echo "<table class='table table-borderless ml-5 mt-5'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Fecha</th>";
  echo "<th scope='col'>Pista</th>";
  echo "<th scope='col'>Opciones</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach($datos as $id){
   $manolo = $id['fecha'];
   $paco = $id['idPista'];
   $jose = $id['idReserva'];
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $manolo</td>";
  echo "<td> $paco</td>";
  echo "<td> <a href='index.php?controller=reserva&amp;action=deleteReserva&amp;idReserva=$jose'> <button class='btn btn-yagami'>Borrar</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>
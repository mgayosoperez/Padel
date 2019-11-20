<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$partidos = $view->getVariable("datos");

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=admin&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Partidos Promocionados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=partidoPromocionado">Crear un Partido Promocionado</a> 
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=showPartidos">Partidos Promocionados</a>
        </div>
      </li>
           <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Campeonatos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=campeonatos">Lista de Campeonatos</a>
          <a class="dropdown-item" href="#">Crear un Campeonato</a> 
          <a class="dropdown-item" href="#">Modificar un Campeonato</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=entrenador&amp;action=index">Entrenadores</a>
      </li>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=admin&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


<?php if(isset($partidos)){
  echo "<table class='table'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>ID</th>";
  echo "<th scope='col'>Fecha</th>";
  echo "<th scope='col'>Opciones</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  $partidoPromocionado = new PartidoPromocionado();
  foreach($partidos as $id){
    $partidoPromocionado = $id;
   $nombre = $partidoPromocionado->getIdPromocionado();
   $fecha = $partidoPromocionado->getFecha();
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $nombre</td>";
  echo "<td> $fecha</td>";
  echo "<td> <a href='index.php?controller=admin&amp;action=borrarPartido&amp;idPartido=$nombre'> <button class='btn btn-yagami'>Borrar</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>

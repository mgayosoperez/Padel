<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();


$partidos = $view->getVariable("pPromocionado");
$partidosInscritos = $view->getVariable("pInscritos");


?>




<?php if(isset($partidos)){
  echo "<div class='container mt-5' >";
  echo "<h4>Partidos Disponibles</h4>";
  echo "<table class='table table-borderless ml-5 mt-5'>";
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
  echo "<td> <a href='index.php?controller=deportista&amp;action=inscribirsePromocionado&amp;idPromocionado=$nombre'> <button class='btn btn-yagami'>Inscribirse</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
  echo "</div>";
}?>
<br>
<?php if(isset($partidosInscritos)){
  echo "<div class='container'>";
  echo "<h4>Partidos Inscritos</h4>";
  echo "<table class='table table-borderless ml-5 mt-5'>";
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
  foreach($partidosInscritos as $id){
    $partidoPromocionado = $id;
   $nombre = $partidoPromocionado->getIdPromocionado();
   $fecha = $partidoPromocionado->getFecha();
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $nombre</td>";
  echo "<td> $fecha</td>";
  echo "<td> <a href='index.php?controller=deportista&amp;action=desinscribirsePromocionado&amp;idPromocionado=$nombre'> <button class='btn btn-yagami'>Desinscribirse</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
  echo "</div>";
}?>

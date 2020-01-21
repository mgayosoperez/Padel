<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../../view/navBar/admin.php");


$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$partidos = $view->getVariable("datos");

?>




<?php if(isset($partidos)){
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
  echo "<td> <a href='index.php?controller=admin&amp;action=borrarPartido&amp;idPartido=$nombre'> <button class='btn btn-yagami'>Borrar</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>

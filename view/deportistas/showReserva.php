<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");
?>


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
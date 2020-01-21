<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/Pareja/ParejaMapper.php");
require_once(__DIR__."/../../model/Playoffs/PlayoffsMapper.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();

$campeonatos = $view->getVariable("campeonato");

?>



<?php if(isset($campeonatos)){
  $mapper = new ParejaMapper();
  //$mapperPO = new PlayoffsMapper();

  echo "<table class='table table-borderless ml-5 mt-5'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Nombre</th>";
  echo "<th scope='col'>Fecha de Inicio</th>";
  echo "<th scope='col'>Fecha de Fin</th>";
  echo "<th scope='col'>Opciones</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach($campeonatos as $id){
   $nombre = $id["nombre"];
   $fechaInicio = $id["fechaInicio"];
   $fechaFin = $id["fechaFin"];
   $idC=$id["idCampeonato"]; 
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $nombre</td>";
  echo "<td> $fechaInicio</td>";
  echo "<td> $fechaFin</td>";
  if(!$mapper->parejaExists($user,$idC)){
     echo "<td><a href='index.php?controller=campeonato&amp;action=inscribirse&amp;idCampeonato=$idC'> <button class='btn btn-yagami'>Incribirse</button> </a> </td>";
  }else{
    if (true) {
      echo "<td> <a href='index.php?controller=campeonato&amp;action=verLiga&amp;idCampeonato=$idC'> <button class='ml-3 btn btn-yagami'>Ver Liga</button> </a>";
      echo " <a href='index.php?controller=campeonato&amp;action=verPlayoffs&amp;idCampeonato=$idC'> <button class='ml-3 btn btn-yagami'>Ver Playoff</button> </a> </td>";
    }else{
      echo "<td> <a href='index.php?controller=campeonato&amp;action=verLiga&amp;idCampeonato=$idC'> <button class='btn btn-yagami'>Ver Liga</button> </a> </td>";
    }
  }
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>




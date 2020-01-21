<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/Grupo/GrupoMapper.php");

require_once(__DIR__."/../../view/navBar/deportista.php");


$view = ViewManager::getInstance();


$ligas = $view->getVariable("ligas");

?>



<?php if(isset($ligas)){
  $mapper = new GrupoMapper();
  $grupoMapper = new ParejaMapper();
  foreach ($ligas as $key => $value) {
    echo "<div>";
    echo "<h1>Liga $value</h1>";
    $grupos = $mapper->getGruposLiga($value);
    foreach ($grupos as $key => $valuee) {
      $aux = $valuee["idGrupo"];
      $parejas = $grupoMapper->parejasGrupo($aux);
      echo "<h3>Grupo $aux</h3>";
      echo "<table class='table'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th scope='col'></th>";
      echo "<th scope='col'>Capitan</th>";
      echo "<th scope='col'>Pareja</th>";
      echo "<th scope='col'>Puntos</th>";
      echo "</tr>";
      echo "</thead>";
      echo "</div>";
      echo "<tbody>";
      foreach ($parejas as $key => $par) {
        $auxcap = $par["capitan"];
        $auxpar = $par["pareja"];
        $auxpun = $par["puntos"];
        $auxIdC = $par["idCampeonato"];
        echo "<tr>";
        echo "<th scope='row'></th>";
        echo "<td> $auxcap</td>";
        echo "<td> $auxpar</td>";
        echo "<td> $auxpun</td>";
        echo "</tr>";
  
      }
        echo "</tbody>";
        echo "</table>";  
    }    
  }
  
}?>
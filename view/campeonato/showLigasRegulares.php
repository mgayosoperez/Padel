<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/Grupo/GrupoMapper.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$ligas = $view->getVariable("ligas");

?>


<?php if(isset($ligas)){
  $mapper = new GrupoMapper();
  $grupoMapper = new ParejaMapper();
  $auxIdC = null;
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
      echo "<th scope='col'>Añadir victoria</th>";
      echo "<th scope='col'>Añadir empate</th>";
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
        echo "<td> <a href='index.php?controller=admin&amp;action=parejaVictoria&amp;idCampeonato=$auxIdC&amp;Capitan=$auxcap&amp;Puntos=$auxpun'> <button class='btn btn-yagami'>Añadir victoria</button> </a> </td>";
        echo "<td> <a href='index.php?controller=admin&amp;action=parejaEmpate&amp;idCampeonato=$auxIdC&amp;Capitan=$auxcap&amp;Puntos=$auxpun'> <button class='btn btn-yagami'>Añadir empate</button> </a> </td>";
        echo "</tr>";
      
      }
        echo "</tbody>";
        echo "</table>";  


    }    

  }

  
  
}?>
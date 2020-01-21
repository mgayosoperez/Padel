<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/LigaRegular/LigaRegularMapper.php");
require_once(__DIR__."/../../model/PlayOffs/PlayOffsMapper.php");
require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$campeonatos = $view->getVariable("campeonato");

?>


<?php if(isset($campeonatos)){
  $mapper = new LigaRegularMapper();
  $mapperPO = new PlayOffsMapper();
  echo "<table class='table'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Nombre</th>";
  echo "<th scope='col'>Fecha de Inicio</th>";
  echo "<th scope='col'>Fecha de Fin</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach($campeonatos as $id){
        $nombre = $id["nombre"];
        $fechaInicio = $id["fechaInicio"];
        $fechaFin = $id["fechaFin"];
        $idC=$id["idCampeonato"]; 
        $ligas =  $mapper->getLigaDeUnCampeonato($idC);
        $playoff = $mapperPO->getIdPlayOffs($idC);

        
        echo "<tr>";
        echo "<th scope='row'></th>";
        echo "<td> $nombre</td>";
        echo "<td> $fechaInicio</td>";
        echo "<td> $fechaFin</td>";
        echo "<td> <a href='index.php?controller=admin&amp;action=deleteCampeonato&amp;idCampeonato=$idC'> <button class='btn btn-yagami'>Eliminar</button> </a> </td>";
        if(!isset($ligas[0])){
        echo "<td> <a href='index.php?controller=admin&amp;action=generarLigaRegular&amp;idCampeonato=$idC&amp;fechaFin=$fechaFin'> <button class='btn btn-yagami'>Generar liga</button> </a> </td>";
        }
        if(isset($ligas[0])){
          
          echo "<td> <a href='index.php?controller=admin&amp;action=gestionarLigas&amp;idCampeonato=$idC&amp;fechaFin=$fechaFin'> <button class='btn btn-yagami'>Ver ligas</button> </a> </td>";
          if (isset($playoff[0])) {
            echo "<td> <a href='index.php?controller=admin&amp;action=generarPlayOffs&amp;idCampeonato=$idC'> <button class='btn btn-yagami'>Ver PlayOffs</button> </a> </td>";
          }else{
            echo "<td> <a href='index.php?controller=admin&amp;action=generarPlayOffs&amp;idCampeonato=$idC'> <button class='btn btn-yagami'>Generar PlayOffs</button> </a> </td>";
          }
          
        }
        
        
        echo "</tr>";

  }
  echo "</tbody>";
  echo "</table>"; 
}?>




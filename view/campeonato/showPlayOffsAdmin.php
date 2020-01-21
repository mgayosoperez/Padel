<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PlayOffs/PlayOffsMapper.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$idC = $view->getVariable("idC");

?>


<?php if(isset($idC)){
  $mapper = new PlayOffsMapper();
  $idPs=$mapper->getIdPlayOffs($idC);
  foreach ($idPs as $key => $value) {
    $idPlay = $value["idPlayoffs"];
    echo "<h1>PlayOff $idPlay</h1>";
    echo "<h3>Cuartos</h3>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Capitan 1</th>";
    echo "<th scope='col'></th>";
    echo "<th scope='col'>Capitan 2</th>";
    echo "<th scope='col'></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $idP = $value["idPlayoffs"];
    $parejasAEnfrentar = $mapper->getParejas($value["idPlayoffs"]);
    $pareja1 = $parejasAEnfrentar[0]["capitan"];
    $pareja8 = $parejasAEnfrentar[7]["capitan"];
    $pareja2 = $parejasAEnfrentar[1]["capitan"];
    $pareja7 = $parejasAEnfrentar[6]["capitan"];
    $pareja3 = $parejasAEnfrentar[2]["capitan"];
    $pareja6 = $parejasAEnfrentar[5]["capitan"];
    $pareja4 = $parejasAEnfrentar[3]["capitan"];
    $pareja5 = $parejasAEnfrentar[4]["capitan"];
    echo "<tr>";
    if ($parejasAEnfrentar[0]["fase"]>1 || $parejasAEnfrentar[7]["fase"]>1) {
      echo "<td>$pareja1</td><td>";if($parejasAEnfrentar[0]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
      echo "<td>$pareja8</td><td>";if($parejasAEnfrentar[7]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
    }else{
      echo "<td>$pareja1</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja1&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
      echo "<td>$pareja8</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja8&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
    }
    echo "</tr>";
    echo "<tr>";
    if ($parejasAEnfrentar[1]["fase"]>1 || $parejasAEnfrentar[6]["fase"]>1) {
      echo "<td>$pareja2</td><td>";if($parejasAEnfrentar[1]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
      echo "<td>$pareja7</td><td>";if($parejasAEnfrentar[6]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
    }else{
      echo "<td>$pareja2</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja2&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
      echo "<td>$pareja7</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja7&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
    }
    echo "</tr>";
    echo "<tr>";
    if ($parejasAEnfrentar[2]["fase"]>1 || $parejasAEnfrentar[5]["fase"]>1) {
      echo "<td>$pareja3</td><td>";if($parejasAEnfrentar[2]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
      echo "<td>$pareja6</td><td>";if($parejasAEnfrentar[5]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
    }else{
      echo "<td>$pareja3</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja3&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
      echo "<td>$pareja6</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja6&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
    }
    echo "</tr>";
    echo "<tr>";
    if ($parejasAEnfrentar[3]["fase"]>1 || $parejasAEnfrentar[4]["fase"]>1) {
      echo "<td>$pareja4</td><td>";if($parejasAEnfrentar[3]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
      echo "<td>$pareja5</td><td>";if($parejasAEnfrentar[4]["fase"]>1){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
    }else{
      echo "<td>$pareja4</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja4&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
      echo "<td>$pareja5</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=2&amp;idCap=$pareja5&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
    }
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";

    $aux=false;
    $parejasCuartos = array();
    foreach ($parejasAEnfrentar as $key => $val) {
      if($val["fase"]>1){
        $aux=true;
        array_push($parejasCuartos, $val);
      }
    }
    
    $lengthCuartos = sizeof($parejasCuartos);
    if($aux && $lengthCuartos == 4){
      echo "<h3>Semifinal</h3>"; 
      echo "<table class='table'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th scope='col'>Capitan 1</th>";
      echo "<th scope='col'></th>";
      echo "<th scope='col'>Capitan 2</th>";
      echo "<th scope='col'></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      echo "<tr>";
      if ($parejasAEnfrentar[0]["fase"]>2 || $parejasAEnfrentar[7]["fase"]>2 || $parejasAEnfrentar[1]["fase"]>2 || $parejasAEnfrentar[6]["fase"]>2) {
        
        if($parejasAEnfrentar[0]["fase"]>2){
          echo "<td>$pareja1</td><td>";if($parejasAEnfrentar[0]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }elseif($parejasAEnfrentar[7]["fase"]>2){
          echo "<td>$pareja8</td><td>";if($parejasAEnfrentar[7]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }else{

          if($parejasAEnfrentar[0]["fase"]==2){
            echo "<td>$pareja1</td><td>";if($parejasAEnfrentar[0]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }else{
            echo "<td>$pareja8</td><td>";if($parejasAEnfrentar[7]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }

        }

        if($parejasAEnfrentar[1]["fase"]>2){
          echo "<td>$pareja2</td><td>";if($parejasAEnfrentar[1]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }elseif($parejasAEnfrentar[6]["fase"]>2){
          echo "<td>$pareja7</td><td>";if($parejasAEnfrentar[6]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }else{

          if ($parejasAEnfrentar[1]["fase"]==2) {
            echo "<td>$pareja2</td><td>";if($parejasAEnfrentar[1]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }else{
            echo "<td>$pareja7</td><td>";if($parejasAEnfrentar[6]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }

        }

      }else{

        if($parejasAEnfrentar[0]["fase"]>1){
          echo "<td>$pareja1</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja1&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }elseif($parejasAEnfrentar[7]["fase"]>1){
          echo "<td>$pareja8</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja8&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }else{
          echo "<td></td>";
        }

        if($parejasAEnfrentar[1]["fase"]>1){
          echo "<td>$pareja2</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja2&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }elseif($parejasAEnfrentar[6]["fase"]>1){
          echo "<td>$pareja7</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja7&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }else{
          echo "<td></td>";
        }

      }
      echo "</tr>";
      echo "<tr>";
      if ($parejasAEnfrentar[2]["fase"]>2 || $parejasAEnfrentar[5]["fase"]>2 || $parejasAEnfrentar[3]["fase"]>2 || $parejasAEnfrentar[4]["fase"]>2) {

        if($parejasAEnfrentar[2]["fase"]>2){
          echo "<td>$pareja3</td><td>";if($parejasAEnfrentar[2]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }elseif($parejasAEnfrentar[5]["fase"]>2){
          echo "<td>$pareja6</td><td>";if($parejasAEnfrentar[5]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }else{

          if($parejasAEnfrentar[2]["fase"]==2){
            echo "<td>$pareja3</td><td>";if($parejasAEnfrentar[2]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }else{
            echo "<td>$pareja6</td><td>";if($parejasAEnfrentar[5]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }

        }

        if($parejasAEnfrentar[3]["fase"]>2){
          echo "<td>$pareja4</td><td>";if($parejasAEnfrentar[3]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }elseif($parejasAEnfrentar[4]["fase"]>2){
          echo "<td>$pareja5</td><td>";if($parejasAEnfrentar[4]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
        }else{

          if ($parejasAEnfrentar[3]["fase"]==2) {
            echo "<td>$pareja4</td><td>";if($parejasAEnfrentar[3]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }else{
            echo "<td>$pareja5</td><td>";if($parejasAEnfrentar[4]["fase"]>2){ echo"Ganador</td>";}else{echo"Perdedor</td>";};
          }

        }
      
      }else{

        if($parejasAEnfrentar[2]["fase"]>1){
          echo "<td>$pareja3</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja3&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }elseif($parejasAEnfrentar[5]["fase"]>1){
          echo "<td>$pareja6</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja6&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }else{
          echo "<td></td>";
        }
        if($parejasAEnfrentar[3]["fase"]>1){
          echo "<td>$pareja4</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja4&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }elseif($parejasAEnfrentar[4]["fase"]>1){
          echo "<td>$pareja5</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=3&amp;idCap=$pareja5&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        }else{
          echo "<td></td>";
        }

      }
      echo "</tr>";
      echo "</tbody>";
      echo "</table>";  
    }

    $patata = false;
    $parejasG = array();
    foreach ($parejasAEnfrentar as $k => $va) {
      if($va["fase"]>2){
        $patata=true;
        array_push($parejasG, $va);
      }
    }

    $length = sizeof($parejasG);
    if($patata && $length == 2){
      echo "<h3>Final</h3>"; 
      echo "<table class='table'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th scope='col'>Capitan 1</th>";
      echo "<th scope='col'></th>";
      echo "<th scope='col'>Capitan 2</th>";
      echo "<th scope='col'></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      echo "<tr>";

      $patata1 = $parejasG[0]["capitan"];
      $patata2 = $parejasG[1]["capitan"];
      if ($parejasG[0]["fase"]>3 || $parejasG[1]["fase"]>3) {
        echo "<td>$patata1</td>";if($parejasG[0]["fase"]>3){ echo"<td class='bg-success text-light'>Ganador</td>";}else{echo"<td class='bg-danger text-light'>Perdedor</td>";};
        echo "<td>$patata2</td>";if($parejasG[1]["fase"]>3){ echo"<td class='bg-success text-light'>Ganador</td>";}else{echo"<td class='bg-danger text-light'>Perdedor</td>";};
      }else{
        echo "<td>$patata1</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=4&amp;idCap=$patata1&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
        echo "<td>$patata2</td><td><a href='index.php?controller=admin&amp;action=ganador&amp;fase=4&amp;idCap=$patata2&amp;idP=$idP'><button class='ml-5 btn btn-yagami'>Ganador</button></a></td>";
      }

      echo "</tr>";
      echo "</tbody>";
      echo "</table>"; 
    }
  }
}?>
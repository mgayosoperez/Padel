<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");
require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$parejas = $view->getVariable("grupos");

?>


<?php if(isset($parejas)){
  echo "<table class='table table-borderless ml-5 mt-5'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Capitan</th>";
  echo "<th scope='col'>Pareja</th>";
  echo "<th scope='col'>Grupo</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach($parejas as $id){
    $capitan = $id["capitan"];
    $pareja = $id["pareja"];
    $grupo= $id["grupo"];
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $capitan</td>";
  echo "<td> $pareja</td>";
  echo "<td> $grupo</td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 

}?>

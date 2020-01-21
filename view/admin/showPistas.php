<?php

require_once(__DIR__."/../../core/ViewManager.php");

require_once(__DIR__."/../../model/Pista/Pista.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$pistas = $view->getVariable("datos");

?>

<?php if(isset($pistas)){
  echo "<table class='table table-borderless ml-5 mt-5'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Numero</th>";
  echo "<th scope='col'>Estado</th>";
  echo "<th scope='col'>Superficie</th>";
  echo "<th scope='col'>Opciones</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  $pistaObjeto = new Pista();
  
  foreach($pistas as $id){
    $pistaObjeto = $id;
   $numero = $pistaObjeto->getIdPista();
   $estado = $pistaObjeto->getEstado();
   $superficie= $pistaObjeto->getSuperficie();

  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $numero</td>";
  echo "<td> $estado</td>";
  echo "<td> $superficie</td>";
  echo "<td> <a href='index.php?controller=pista&amp;action=borrarPista&amp;idPista=$numero'> <button class='btn btn-yagami'>Borrar</button> </a> </td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>

<form  action="index.php?controller=pista&amp;action=addPista" method="POST" class="text-center">
  <input hidden type="text" name="fecha" id="input" >
   <input type="submit" value="Añadir Pista" class="btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>

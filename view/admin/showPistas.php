<?php

require_once(__DIR__."/../../core/ViewManager.php");

require_once(__DIR__."/../../model/Pista/Pista.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$pistas = $view->getVariable("datos");

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=admin&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Partidos Promocionados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=partidoPromocionado">Crear un Partido Promocionado</a> 
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=showPartidos">Partidos Promocionados</a>
        </div>
      </li>
           <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Campeonatos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=campeonatos">Lista de Campeonatos</a>
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=crearCampeonato">Crear un Campeonato</a>       </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=entrenador&amp;action=index">Entrenadores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=verPistas">Pistas</a>
      </li>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=admin&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


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

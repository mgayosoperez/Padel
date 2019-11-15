<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=deportista&amp;action=reserva">Reservas<span class="sr-only"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=reserva&amp;action=campeonatos">Campeonatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=deportista&amp;action=clases">Clases</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
   	<div class="mr-5 text-light"><?= $user?></div>
    <a 	href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


<div class="container">
  <h2>Carousel Example</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="icon/p1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="icon/p2.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="icon/p3.jpg" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<?php if(isset($datos)){
  echo "<table class='table'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'></th>";
  echo "<th scope='col'>Fecha</th>";
  echo "<th scope='col'>Pista</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach($datos as $id){
   $manolo = $id['fecha'];
   $paco = $id['idPista'];
  echo "<tr>";
  echo "<th scope='row'></th>";
  echo "<td> $manolo</td>";
  echo "<td> $paco</td>";
  echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
}?>
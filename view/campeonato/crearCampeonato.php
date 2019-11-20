<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");
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
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=crearCampeonato">Crear un Campeonato</a>
          <a class="dropdown-item" href="#">Modificar un Campeonato</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=entrenador&amp;action=index">Entrenadores</a>
      </li>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=admin&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h2 class="text-light">Crear un Campeonato</h2>
                      <br>
                      <form action="index.php?controller=admin&amp;action=addCampeonato" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre campeonato">
                        </div>
                            <div class="form-group">
                            <input type="date" class="form-control" name="fechaInicio" placeholder="Fecha Inicio">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fechaFin" placeholder="Fecha Fin">
                        </div>
                            <div>
                              <h8 class="text-light"><?php if(isset($errors["cam"])){echo $errors["cam"];}
                              if(isset($errors["login"])){echo $errors["login"];}?></h8>
                              <br>
                              <br>
                            </div>
                            <input type="submit" id="sendFecha" class="btn btn-dark" value="Crear campeonato"></input>

                      </form >

                    </div>
                </div>
            </div>
      </div>
  </div>
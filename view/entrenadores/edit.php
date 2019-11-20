<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$entrenador = $view->getVariable("entrenador");

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
          <a class="dropdown-item" href="#">Crear un Campeonato</a>
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
            <h2 class="text-light">Editar Entrenador</h2>
<form action="index.php?controller=entrenador&amp;action=update" method="POST">
      <div class="form-group">
          <label class="text-light" ><?= i18n("Username")?></label>
          <input type="text" readonly="readonly" class="form-control" name="username" value="<?= $entrenador->getLogin()?>">
      </div>
      <div class="form-group">
          <label class="text-light" ><?= i18n("Password")?></label>
          <input type="password" class="form-control" name="passwd" value="<?= $entrenador->getPasswd()?>">
      </div>
      <div class="form-group">
          <label class="text-light" ><?= i18n("Dni")?></label>
          <input type="text" class="form-control" name="dni" value="<?= $entrenador->getDni()?>">
      </div>
      <div class="form-group">
         <label class="text-light" ><?= i18n("Nss")?></label>
          <input type="text" class="form-control" name="nss" value="<?= $entrenador->getNss()?>">
      </div>
      <div class="form-group">
          <label class="text-light" ><?= i18n("Nombre")?></label>
          <input type="text" class="form-control" name="nombre" value="<?= $entrenador->getNombre()?>">
      </div>
      <div class="form-group">
          <label class="text-light" ><?= i18n("Apellidos")?></label>
          <input type="text" class="form-control" name="apellidos" value="<?= $entrenador->getApellidos()?>">
      </div>
      <div class="form-group text-light ml-3">
       <h6>Gender:</h6>
       <input type="radio" name="sexo" value="HOMBRE" checked> Male<br>
       <input type="radio" name="sexo" value="MUJER"> Female<br>
     </div>


      <div>
        <br>
        <h8 class="text-light"><?= isset($errors["telefono"])?i18n($errors["telefono"]):"" ?>
          <?= isset($errors["nombre"])?i18n($errors["nombre"]):"" ?>
          <?= isset($errors["email"])?i18n($errors["email"]):"" ?>
          <?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?>
          <?= isset($errors["username"])?i18n($errors["username"]):"" ?>
        </h8>
        <br>
      </div>

      <input type="submit" id="sendlogin" class="btn btn-dark" value="<?= i18n("Editar")?>"></input>

</form >
</div>
</div>
</div>
</div>
</div>

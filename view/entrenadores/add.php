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
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=verPistas">Pistas</a>
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
            <h2 class="text-light">Añadir Entrenador</h2>
  <form action="index.php?controller=entrenador&amp;action=add" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="<?=i18n("Username")?>">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="passwd" placeholder="<?=i18n("Password")?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="dni" placeholder="<?=i18n("DNI")?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="nss" placeholder="<?=i18n("NSS")?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="nombre" placeholder="<?=i18n("Nombre")?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="apellidos" placeholder="<?=i18n("Apellidos")?>">
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

        <input type="submit" id="sendlogin" class="btn btn-dark" value="<?= i18n("Añadir")?>"></input>

  </form >
</div>
</div>
</div>
</div>
</div>

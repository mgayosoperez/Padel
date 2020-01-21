<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");
?>

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

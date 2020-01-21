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
$entrenador = $view->getVariable("entrenador");

?>



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

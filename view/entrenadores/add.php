<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
//$user = $view->getVariable("user");
?>

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
      <div class="form-group">
          <input type="text" class="form-control" name="sexo" placeholder="<?=i18n("Sexo")?>">
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

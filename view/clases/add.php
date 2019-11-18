<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
//$user = $view->getVariable("user");
?>

<form action="index.php?controller=clase&amp;action=add" method="POST">
      <div class="form-group">
          <input type="number" class="form-control" name="maxAlum" placeholder="<?=i18n("Maximo de Alumnos")?>">
      </div>
      <div class="form-group">
          <input type="text" class="form-control" name="descripcion" placeholder="<?=i18n("Descripcion de la clase")?>">
      </div>

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

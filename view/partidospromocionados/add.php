<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
//$user = $view->getVariable("user");
?>

<form action="index.php?controller=admin&amp;action=addPartidoPromocionado" method="POST">

      <div class="form-group">
          <input type="text" class="form-control" name="fecha" placeholder="<?=i18n("Fecha")?>">
      </div>

      <div class="form-group">
          <input type="text" class="form-control" name="numDeportista" placeholder="<?=i18n("Numero De Deportistas")?>">
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

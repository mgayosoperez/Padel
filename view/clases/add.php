<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=clase&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Clases
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=add">Crear mis clases</a>
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=showClases">Ver mis clases</a>
        </div>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=entrenador&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

<form action="index.php?controller=clase&amp;action=add" method="POST">
      <div class="form-group">
          <input type="number" class="form-control" name="maxAlum" placeholder="<?=i18n("Maximo de Alumnos")?>">
      </div>
      <div class="form-group">
          <input type="datetime-local" class="form-control" name="fecha" placeholder="<?=i18n("Fecha")?>">
      </div>
      <div class="form-group">
          <input type="text" class="form-control" name="descripcion" placeholder="<?=i18n("Descripcion")?>">
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

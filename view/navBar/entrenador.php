<?php

require_once(__DIR__."/../../core/ViewManager.php");

require_once(__DIR__."/../../model/Notificacion/NotificacionMapper.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

function mensaje($user){
  $NotificacionMapper = new NotificacionMapper();
  if($NotificacionMapper->existenNuevos($user)){
    echo "<img src='icon/mensajeNuevo.png' height='25' width='30'>";
  }
  else{
    echo "<img src='icon/mensajeLeido.png' height='25' width='25' class='mr-2'>";
  }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=clase&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php mensaje($user) ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="index.php?controller=notificaciones&amp;action=addEntrenador">Crear Notificacion</a>
            <a class="dropdown-item" href="index.php?controller=notificaciones&amp;action=verNotificacionesEnviadasEntrenador">Notificaciones enviadas</a>
            <a class="dropdown-item" href="index.php?controller=notificaciones&amp;action=verNotificacionesEntrenador">Notificaciones recibidas</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=entrenador&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>
<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

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
        <a class="nav-link" href="index.php?controller=admin&amp;action=entrenadores">Entrenadores</a>
      </li>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=admin&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

<table class="tab-twocol shadow showtable" border= 1>
   <tr>
       <th><?= i18n("Login")?></th>
       <td><?= $entrenador->getLogin()?></td>
   </tr>
   <tr>
       <th><?= i18n("Password")?></th>
       <td><?= $entrenador->getPasswd()?></td>
   </tr>
   <tr>
       <th><?= i18n("Dni")?></th>
       <td><?= $entrenador->getDni()?></td>
   </tr>
   <tr>
       <th><?= i18n("NSS")?></th>
       <td><?= $entrenador->getNss()?></td>
   </tr>
   <tr>
       <th><?= i18n("Nombre")?></th>
       <td><?= $entrenador->getNombre()?></td>
   </tr>
   <tr>
       <th><?= i18n("Apellidos")?></th>
       <td><?= $entrenador->getApellidos()?></td>
   </tr>
   <tr>
       <th><?= i18n("Sexo")?></th>
       <td><?= $entrenador->getSexo()?></td>
   </tr>
 </table>
 <a href="index.php?controller=entrenador&amp;action=delete&amp;username=<?=$entrenador->getLogin()?>"><button class='btn btn-yagami'>Borrar</button></a>

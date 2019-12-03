<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$listaEntrenadores = $view->getVariable("entrenadores");


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




  <table class="table table-borderless ml-5 mt-5">
          <tr>
              <!-- Títulos de la -->
              <th>
                  Login
              </th>
              <th>
                  Password
              </th>
              <th>
                  Dni
              </th>
              <th>
                  NSS
              </th>
              <th>
                  Nombre
              </th>
              <th>
                  Apellidos
              </th>
              <th>
                  Sexo
              </th>          
          </tr>

        <?php foreach ($listaEntrenadores as $entrenador){?>
          <tr>
              <td><?= $entrenador->getLogin()?></td>
              <td><?= $entrenador->getPasswd()?></td>
              <td><?= $entrenador->getDni()?></td>
              <td><?= $entrenador->getNss()?></td>
              <td><?= $entrenador->getNombre()?></td>
              <td><?= $entrenador->getApellidos()?></td>
              <td><?= $entrenador->getSexo()?></td>
              <td><!--OjO BOTONES-->
                <a href="index.php?controller=entrenador&amp;action=update&amp;login=<?=$entrenador->getLogin()?>"><button class='btn btn-yagami'>Editar</button></a>

              </td>
              <td>
                <a href="index.php?controller=entrenador&amp;action=delete&amp;username=<?=$entrenador->getLogin()?>"><button class='btn btn-yagami'>Borrar</button></a>
                <?php /* ?><a href="index.php?controller=entrenador&amp;action=delete&amp;login=<?=$entrenador->getLogin()?>">Borrar</a>?><?*/?>


              </td>
          </tr>
        <?php } ?>
      </table>

<form  action="index.php?controller=entrenador&amp;action=add" method="POST" class="text-center">
   <input type="submit" value="Añadir entrenador" class="mt-5 btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>

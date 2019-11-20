<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$entrenadores = $view->getVariable("entrenadores");
$listaMisClasesParticulares = $view->getVariable("misClasesParticulares");
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=deportista&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reservas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=reserva">Crear reserva</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showReservas">Ver reservas</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showPromocionados">Partidos Promocionados</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=deportista&amp;action=campeonatos">Campeonatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesGrupales">Clases Grupales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesParticulares">Clases Particulares</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


  <table class="table  table-borderless ml-5 mt-5 ">

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaMisClasesParticulares as $clase){?>

            <tr>
              <td><?= $clase->getIdClase()?></td>
              <td><?= $clase->getFecha()?></td>
              <td><?= $clase->getLogin()?></td>
              <td>
                <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>&reserva=<?= $clase->getReserva()?>"><button class='btn btn-yagami'>Desinscribir</button></a>
              </td>

          </tr>
        <?php
      } ?>
      </table>
      <a href="index.php?controller=clase&amp;action=inscribirseParticular"><button class='btn btn-yagami'>Crear Particular</button></a></a>
      

<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$listaClasesGrupales = $view->getVariable("clasesGrupales");
$listaClasesParticulares = $view->getVariable("clasesParticulares");
$listaMisClasesGrupales = $view->getVariable("misclasesGrupales");
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Clases
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="index.php?controller=clase&amp;action=clasesGrupales">Clases Grupales</a>
           <a class="dropdown-item" href="index.php?controller=clase&amp;action=clasesParticulares">Clases Particulares</a>
         </div>
      </li>
    </ul>
  </div>
  <form class="form-inline">
   	<div class="mr-5 text-light"><?= $user?></div>
    <a 	href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>




<h1>Clases Grupales</h1>

  <table class="table" border=1>

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  Maximo de Alumnos
              </th>
              <th>
                  Descripcion
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaClasesGrupales as $clase){
                if (in_array($clase->getIdClase(), $listaMisClasesGrupales)) {?>
                  <tr bgcolor="#FF0000">
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getMaxAlum()?></td>
                    <td><?= $clase->getDescripcion()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>

                    <td>
                      <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>">Desinscribirse</a> </button>
                    </td>
                </tr>
          <?php }else{?>
                    <tr>

        <td><?= $clase->getIdClase()?></td>
        <td><?= $clase->getMaxAlum()?></td>
        <td><?= $clase->getDescripcion()?></td>
        <td><?= $clase->getFecha()?></td>
        <td><?= $clase->getLogin()?></td>

        <td>
          <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
        </td>
    </tr>
    <?php }?>
  <?php  } ?>
      </table>



      <h1>Clases Particulares</h1>

        <table class="table" border=1>

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
              <?php foreach ($listaClasesParticulares as $clase){
                if(in_array($clase->getIdClase(), $listaMisClasesParticulares)){?>
                  <tr bgcolor="#FF0000">
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>
                    <td>
                      <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>">Desinscribirse</a> </button>
                    </td>

                </tr>
              <?php }else {?>
                <tr>
                  <td><?= $clase->getIdClase()?></td>
                  <td><?= $clase->getFecha()?></td>
                  <td><?= $clase->getLogin()?></td>
                  <td>
                    <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
                  </td>
            <?php  }
            } ?>
            </table>

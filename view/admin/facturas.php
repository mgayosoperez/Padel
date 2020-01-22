<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$pagos = $view->getVariable("facturas");
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
          <a class="dropdown-item" href="index.php?controller=admin&amp;action=crearCampeonato">Crear un Campeonato</a>       </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=entrenador&amp;action=index">Entrenadores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=verPistas">Pistas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=admin&amp;action=facturas">Facturas</a>
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
                idFactura
            </th>
            <th>
                Fecha
            </th>
            <th>
                Importe
            </th>
            <th>
                Descripción
            </th>
            <th>
                Deportista
            </th>

        </tr>
      <?php foreach ($pagos as $pago){
              if ($pago->getPagado() == 0) {?>
                <tr bgcolor="#96FE6C">
                  <td><?= $pago->getIdFactura()?></td>
                  <td><?= $pago->getFecha()?></td>
                  <td><?= $pago->getImporte()?></td>
                  <td><?= $pago->getDescripcion()?></td>
                  <td><?= $pago->getDeportista()?></td>

                  <td>
                    <!--<button class='btn btn-yagami'>Ver</button>-->
                  </td>
              </tr>
        <?php }else{?>
                  <tr>

                    <td><?= $pago->getIdFactura()?></td>
                    <td><?= $pago->getFecha()?></td>
                    <td><?= $pago->getImporte()?></td>
                    <td><?= $pago->getDescripcion()?></td>
                    <td><?= $pago->getDeportista()?></td>


  </tr>
  <?php }?>
<?php  } ?>
    </table>
    <a class="nav-link" href="index.php?controller=admin&amp;action=addFactura">Añadir Factura</a>

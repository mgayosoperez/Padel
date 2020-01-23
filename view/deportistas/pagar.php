<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$idFactura = $view->getVariable("idFactura");
$importe = $view->getVariable("importe");
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
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Deportista&amp;action=pagos">Pagos</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>
<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h1 class="text-light">Importe: <?= $importe ?> €</h1>
                      <h2 style="font-size:13px;"class="text-light">Your payment is secure. Your card details will not be shared with sellers.</h2>
  <form class="" action="index.php?controller=deportista&amp;action=pagar" method="post">
    <div class="form-group">
      <input type="text" class="form-control" name="idFactura"  value="<?= $idFactura?>" readonly>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="card" placeholder="Card Number">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="date" placeholder="Expiration date">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="code" placeholder="Security code">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="First name">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="lastname" placeholder="Last name">
    </div>
    <input type="submit" class="btn btn-yagami" value="Pagar"></input>
  </form>
</div>
</div>
</div>
</div>
</div>

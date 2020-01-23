<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../view/navBar/deportista.php");
$view = ViewManager::getInstance();
$idFactura = $view->getVariable("idFactura");
$importe = $view->getVariable("importe");
?>

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

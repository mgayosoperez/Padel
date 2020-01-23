<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../view/navBar/admin.php");
$view = ViewManager::getInstance();


$view->setVariable("title", "index");
$pagos = $view->getVariable("facturas");
?>


<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <div class="text-light">
            						<img src="icon/padel.png" height="45" width="45" class="mr-2" >Padelo
            					</div>

  <form class="" action="index.php?controller=admin&amp;action=addFactura" method="post">

    <div class="form-group">
      <input type="number" class="form-control" name="importe" placeholder="Importe">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="descripcion" placeholder="Descripción">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="deportista" placeholder="Cliente">
    </div>
    <input type="submit" class="btn btn-yagami" value="Enviar"></input>
  </form>
</div>
</div>
</div>
</div>
</div>

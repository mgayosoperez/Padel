<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$view->setVariable("title", "index");
$pagos = $view->getVariable("facturas");
?>


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
    <a class="nav-link" href="index.php?controller=admin&amp;action=addFactura"><button class='btn btn-yagami'>Añadir Factura</button></a>

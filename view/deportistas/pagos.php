<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../view/navBar/deportista.php");
$view = ViewManager::getInstance();
$pagos = $view->getVariable("misPagos");
?>




<table class="table table-borderless ml-5 mt-5">

        <tr>
            <!-- Títulos de la -->
            <th>
                Fecha
            </th>
            <th>
                Importe
            </th>
            <th>
                Descripción
            </th>

        </tr>
      <?php foreach ($pagos as $pago){
              if ($pago->getPagado() == 0) {?>
                <tr bgcolor="#96FE6C">
                  <td><?= $pago->getFecha()?></td>
                  <td><?= $pago->getImporte()?></td>
                  <td><?= $pago->getDescripcion()?></td>

                  <td>
                    <!--<button class='btn btn-yagami'>Ver</button>-->
                  </td>
              </tr>
        <?php }else{?>
                  <tr>

      <td><?= $pago->getFecha()?></td>
      <td><?= $pago->getImporte()?></td>
      <td><?= $pago->getDescripcion()?></td>

      <td>
        <a href="index.php?controller=deportista&amp;action=pagar&amp;idFactura=<?= $pago->getIdFactura()?>&amp;importe=<?= $pago->getImporte() ?>"><button class='btn btn-yagami'>Pagar</button></a>
      </td>
  </tr>
  <?php }?>
<?php  } ?>
    </table>

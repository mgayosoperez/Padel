<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

$entrenador = $view->getVariable("entrenador");



?>


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

<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Notificacion/NotificacionMapper.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();

$user = $_SESSION["currentuser"];

?>



<?php if(isset($user)){
  $mapper = new NotificacionMapper();
  $Notificaciones = $mapper->mensajesEnviados($user);
  echo "<div class='container'>";

  foreach($Notificaciones as $id){
  echo "<div class='container border mt-md-4'>";
  $destinatario = $id["destinatario"];
  $mensaje = $id["mensaje"];
  echo "<h5>Destinatario: $destinatario</h5>";
  echo "<h5 class='mt-2'>Mensaje:</h5>";
  echo "<div class='mt-md-2 border'>$mensaje</div>";
  echo "</div>";
  }
  echo "</div>"; 
}?>

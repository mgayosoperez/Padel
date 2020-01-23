<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Notificacion/NotificacionMapper.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();

$user = $_SESSION["currentuser"];

?>



<?php if(isset($user)){
  $mapper = new NotificacionMapper();
  $Notificaciones = $mapper->mensajesRecibidos($user);
  echo "<div class='container'>";

  foreach($Notificaciones as $id){
    if($id["new"]==1){
      $mapper->verMensaje($id["idNotificacion"]);
      echo "<div class='container border border-danger mt-md-4'>";
      $emisor = $id["emisor"];
      $mensaje = $id["mensaje"];
      echo "<h5>Emisor: $emisor</h5>";
      echo "<h5 class='mt-2'>Mensaje:</h5>";
      echo "<div class='mt-md-2 border'>$mensaje</div>";
      echo "</div>";
    }else{
      echo "<div class='container border mt-md-4'>";
      $emisor = $id["emisor"];
      $mensaje = $id["mensaje"];
      $idN = $id["idNotificacion"];
      echo "<h5>Emisor: $emisor</h5>";
      echo "<h5 class='mt-2'>Mensaje:</h5>";
      echo "<div class='mt-md-2 border'>$mensaje</div>";
      echo "<a href='index.php?controller=notificaciones&amp;action=deleteA&amp;idN=$idN'> <button class='btn btn-yagami'>Borrar</button> </a>";
      echo "</div>";
    }
  
  }
  echo "</div>"; 
}?>

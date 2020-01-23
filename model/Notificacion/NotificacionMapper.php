<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Notificacion/Notificacion.php");

class NotificacionMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function crearUniCast(Notificacion $notificacion){

  	$sql = $this->db->prepare("INSERT INTO abp.notificaciones (emisor, destinatario, mensaje)
                                VALUES (?,?,?);");
    $sql->execute(array($notificacion->getEmisor(), $notificacion->getDestinatario(), $notificacion->getMensaje()));

  }
  
  public function existenNuevos($user){

  	$sql = $this->db->prepare("SELECT count(new) FROM abp.notificaciones WHERE notificaciones.destinatario = ? AND notificaciones.new = 1;");

  	$sql->execute(array($user));

  	if ($sql->fetchColumn() > 0){
      return true;
    }else{
      return false;
    }
  }
  
  public function mensajesRecibidos($user){

  	$sql = $this->db->prepare("SELECT * FROM abp.notificaciones WHERE notificaciones.destinatario = ? ORDER BY notificaciones.new DESC;");
  	
  	$sql->execute(array($user));

  	$mensajes = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $mensajes;
  }

  public function mensajesEnviados($user){

  	$sql = $this->db->prepare("SELECT * FROM abp.notificaciones WHERE notificaciones.emisor = ?;");
  	
  	$sql->execute(array($user));

  	$mensajes = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $mensajes;
  }

  public function verMensaje($idNotificacion){

  	$auxiliar = $idNotificacion;

  	$stmt = $this->db->prepare("UPDATE abp.notificaciones SET notificaciones.new = 0 WHERE notificaciones.idNotificacion = ?;");

  	$stmt->execute(array($idNotificacion));


  	//$sql = $this->db->prepare("SELECT * FROM abp.notificaciones WHERE notificaciones.idNotificacion = ?;");

  	//$sql->execute(array($auxiliar));

  }

  public function delete($idNotificacion){

  	$sql = $this->db->prepare("DELETE FROM abp.notificaciones WHERE notificaciones.idNotificacion = ?;");

  	$sql->execute(array($idNotificacion));
  }

  public function crearBroadCast(Notificacion $notificacion, $tipoDestino){

 	if($tipoDestino == 'DEPORTISTA' || $tipoDestino == 'ENTRENADOR' || $tipoDestino == 'TODOS'){
 		if ($tipoDestino == 'TODOS') {
 		 		
	 		$sql = $this->db->prepare("SELECT usuario.login FROM abp.usuario WHERE NOT usuario.login = ?;");
	  		$sql->execute(array($notificacion->getEmisor())); 

	  		$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
	  	}else{

	  		$sql = $this->db->prepare("SELECT usuario.login FROM abp.usuario WHERE usuario.rol = ?;");
	  		$sql->execute(array($tipoDestino)); 

	  		$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
	  	}
		if (isset($usuarios)) {
			
			foreach ($usuarios as $key => $value) {
				
				$sql = $this->db->prepare("INSERT INTO abp.notificaciones (emisor, destinatario, mensaje)
                        VALUES (?,?,?);");

				$sql->execute(array($notificacion->getEmisor(), $value["login"], $notificacion->getMensaje()));

			}
	  	}
	}  	

  }

}
 ?>

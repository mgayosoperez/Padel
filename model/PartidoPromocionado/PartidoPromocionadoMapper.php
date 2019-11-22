<?php
require_once(__DIR__."/../../core/PDOConnection.php");

require_once(__DIR__."/../../model/PartidoPromocionado/PartidoPromocionado.php");


class PartidoPromocionadoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function verDisponiblesAdmin(){

    $stmt = $this->db->prepare("SELECT * FROM partido_promocionado WHERE partido_promocionado.fecha > ? ");
    $fecha = date("Y-m-d H:i" ,time());
    $stmt->execute(array($fecha));

    $pPromocionados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $toRet = array();

    foreach ($pPromocionados as $key) {

      array_push($toRet, new PartidoPromocionado($key["idPromocionado"], $key["fecha"]));
    }
    return $toRet;
  }

  public function verDisponibles($login){
      $stmt = $this->db->prepare("SELECT * FROM partido_promocionado WHERE partido_promocionado.fecha > NOW()");

    $stmt->execute();
    
    $pPromocionados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $toRet = array();

    foreach ($pPromocionados as $key) {
     
      array_push($toRet, new PartidoPromocionado($key["idPromocionado"], $key["fecha"]));
    }
    return $toRet;
  }

  public function verInscritos($login){

    $stmt = $this->db->prepare("SELECT * FROM partido_promocionado, promocionado_has_deportista WHERE
                                partido_promocionado.idPromocionado = promocionado_has_deportista.idPromocionado AND
                                partido_promocionado.fecha > ? AND promocionado_has_deportista.deportista = ?");
    
    $fecha = date("Y-m-d H:i" ,time());

    $stmt->execute(array($fecha, $login));

    $pPromocionados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $toRet = array();

    foreach ($pPromocionados as $key) {

      array_push($toRet, new PartidoPromocionado($key["idPromocionado"], $key["fecha"]));
    }
    return $toRet;

  }

  public function add(PartidoPromocionado $partido){
    $stmt = $this->db->prepare("INSERT INTO partido_promocionado(fecha)
                                values (?)");

    $stmt->execute(array($partido->getFecha()));
  }

  public function delete($partido){
    $stmt = $this->db->prepare("DELETE from partido_promocionado WHERE idPromocionado=?");
    $stmt->execute(array($partido));
  }


  public function inscribirse($login, $idPromocionado){
    $stmt = $this->db->prepare("INSERT INTO PROMOCIONADO_HAS_DEPORTISTA (idPromocionado, deportista) VALUES (?,?)");

    $stmt->execute(array($idPromocionado, $login));

  }

  public function desinscribirse($login, $idPromocionado){
    $stmt = $this->db->prepare("DELETE FROM PROMOCIONADO_HAS_DEPORTISTA WHERE deportista = ? AND idPromocionado = ?");

    $stmt->execute(array($login, $idPromocionado));
  }

  public function numDeportistas($idPromocionado){
    $stmt = $this->db->prepare("SELECT count(deportista) FROM PROMOCIONADO_HAS_DEPORTISTA WHERE idPromocionado = ?");

    $stmt->execute(array($idPromocionado));

    return $stmt->fetchColumn();

  }

  //LA PISTA VA A MACHETE, HAY QUE CAMBIARLO
  public function crearReserva(PartidoPromocionado $partido){

    $id = $partido->getIdPromocionado();
    $fecha = $partido->getFecha();
                                                                          //MACHETE!!!!!!!
    $stmt = $this->db->prepare("INSERT INTO RESERVA (fecha, idPista) VALUES (?,'1')");
    $stmt->execute(array($fecha));

    $auxiliar =  $this->db->lastInsertId();

    $sql = $this->db->prepare("UPDATE PARTIDO_PROMOCIONADO SET idReserva = ? WHERE idPromocionado = ?");
    $sql->execute(array($auxiliar, $id));
    
  }

  public function existePromocionado($idPromocionado) {
		$stmt = $this->db->prepare("SELECT count(idPromocionado) FROM partido_promocionado where idPromocionado=?");
		$stmt->execute(array($idPromocionado));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
  }

  public function findByIdPromocionado($idPromocionado) {
    $stmt = $this->db->prepare("SELECT * FROM PARTIDO_PROMOCIONADO where idPromocionado = ?");
		$stmt->execute(array($idPromocionado));
    $promocionado = $stmt->fetch(PDO::FETCH_ASSOC);

    if($promocionado != null) {
      return $promocionado;
    } else {
      return NULL;
    }
  }

  public function countPartidos($fecha){
      $stmt = $this->db->prepare("SELECT count(idPromocionado) FROM partido_promocionado where fecha=?");
      $stmt->execute(array($fecha));
      $toret="0";
      $numPartidos = $stmt->fetch(PDO::FETCH_ASSOC);

    if($numPartidos!=NULL){
      foreach ($numPartidos as $key) {
        $toret= $key;
      }
    }
    return $toret;
  }

}
 ?>

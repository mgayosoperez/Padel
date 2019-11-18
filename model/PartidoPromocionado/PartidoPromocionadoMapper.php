<?php
require_once(__DIR__."/../../core/PDOConnection.php");


class PartidoPromocionadoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function findAll(){
    $stmt = $this->db->query("SELECT * FROM partido_promocionado");

    $pPromocionados_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pPromocionados = array();
    foreach ($pPromocionados_db as $pPromocionado) {

      array_push($pPromocionados, new PartidoPromocionado($pPromocionado["idPromocionado"], $pPromocionado["fecha"],
                $pPromocionado["idReserva"]));
    }
    return $pPromocionados;
  }

  public function add(PartidoPromocionado $partido){
    $stmt = $this->db->prepare("INSERT INTO partido_promocionado(fecha)
                                values (?)");

    $stmt->execute(array($partido->getFecha()));
  }

  public function delete(PartidoPromocionado $partido){
    $stmt = $this->db->prepare("DELETE from partido_promocionado WHERE idPromocionado=?");
    $stmt->execute(array($partido->getIdPromocionado()));

    if ($this->db->query($stmt)) {

        return "Borrado realizado con exito";

    } else {
        return "Error en el borrado";
    }
  }


  public function inscribirse($login, $idPromocionado){
    $stmt = $this->db->prepare("INSERT INTO PROMOCIONADO_HAS_DEPORTISTA (idPromocionado, deportista) VALUES (?,?)");

    $stmt->execute(array($idPromocionado, $login));

    if ($this->db->query($stmt)){
      return "Inscrito."
    }else{
      return "Error";
    }
  }

  public function numDeportistas($idPromocionado){
    $stmt = $this->db->prepare("SELECT count(deportista) FROM PROMOCIONADO_HAS_DEPORTISTA WHERE idPromocionado = ?");

    $stmt->execute(array($idPromocionado));

    return $stmt->fechColumn();

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

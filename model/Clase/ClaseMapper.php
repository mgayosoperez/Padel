<?php
require_once(__DIR__."/../core/PDOConnection.php");

class ClaseMapper{

  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function crear(Clase $clase){
    $stmt = $this->db->prepare("INSERT INTO CLASE values (?,?,?,?)");
		$stmt->execute(array($clase->getIdClase(), $clase->getNumAlum(),
			$clase->getHora(), $clase->getLogin()));
  }

  public function delete(Clase $clase) {
    $stmt = $this->db->prepare("DELETE from CLASE WHERE idClase=?");
    $stmt->execute(array($clase->getIdClase()));
  }

  public function showall(){
    $stmt = $this->db->prepare("SELECT * from CLASE");
    $clases = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $clases;
  }

  public function existeClaseHora($hora){
    $stmt = $this->db->prepare("SELECT count(hora) from CLASE WHERE hora = ?");
    $stmt->execute(array($hora));

    if ($stmt->fetchColumn > 0) {
      return true;
    }else{
      return false;
    }
  }

  public function existeClaseId($idClase){
    $stmt = $this->db->prepare("SELECT count(idClase) from CLASE WHERE idClase = ?");
    $stmt->execute(array($idClase));

    if ($stmt->fetchColumn > 0) {
      return true;
    }else{
      return false;
    }
  }


}

 ?>

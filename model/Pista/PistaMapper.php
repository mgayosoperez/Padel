<?php
require_once(__DIR__."/../../core/PDOConnection.php");

require_once(__DIR__."/../../model/Pista/Pista.php");

class PistaMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Pista $pista){
    $sql = $this->db->prepare("INSERT INTO Pista(estado, superficie)
                                VALUES (?,?)");
    $sql->execute(array($pista->getEstado(), $pista->getSuperficie()));

  }

  public function delete($numPista){
    $sql = $this->db->prepare("DELETE FROM Pista WHERE idPista = ?");

    $sql->execute(array($numPista));

  }

  public function showPistas(){

    $sql = $this->db->prepare("SELECT * FROM PISTA");

    $sql->execute();

    $pista = $sql->fetchAll(PDO::FETCH_ASSOC);

    $toRet = array();

    foreach ($pista as $key) {

      array_push($toRet, new Pista($key["idPista"], $key["estado"], $key["superficie"]));
    }
    return $toRet;
  }

    public function numeroPistas(){
    $sql = $this->db->prepare("SELECT count(idPista) FROM PISTA");
    $sql->execute();
    $toret="";
    $reservasFecha = $sql->fetch(PDO::FETCH_ASSOC);
    foreach ($reservasFecha as $key) {
      $toret= $key;
    }
    return $toret;
  }  

}
 ?>
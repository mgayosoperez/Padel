<?php
require_once(__DIR__."/../../core/PDOConnection.php");


class EnfrentamientoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(){
    
    $sql = $this->db->prepare("INSERT INTO PAREJA (idReserva, ganador) 
                                VALUES (null, null)");
    $sql->execute(array());
    $auxiliar =  $this->db->lastInsertId();
    return  $auxiliar;
  }

  public function addPar($pareja,$enfrentamiento){
    
    $sql = $this->db->prepare("INSERT INTO pareja_has_enfrentamiento (idPartido, pareja, puntos) 
                                VALUES ( ?, ?, null)");
    $sql->execute(array($enfrentamiento,$pareja));
  }
}
 ?>
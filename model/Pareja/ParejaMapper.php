<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Pareja/Pareja.php");

class ParejaMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Pareja $pareja){
    
    $sql = $this->db->prepare("INSERT INTO PAREJA (capitan, pareja, idCampeonato, categoria, nivel, grupo, puntos) 
                                VALUES (?,?,?,?,?,null,'0')");

    $sql->execute(array($pareja->getCapitan(), $pareja->getPareja(), $pareja->getIdCampeonato(), $pareja->getCategoria(), $pareja->getNivel()));

    $auxiliar =  $this->db->lastInsertId();
    return  $auxiliar;
  }

  public function parejaExists($pareja, $idCampeonato){

    $sql = $this->db->prepare("SELECT count(capitan) FROM PAREJA WHERE capitan = ? AND idCampeonato = ?");

    $sql->execute(array($_SESSION["currentuser"], $idCampeonato));    

    $stmt = $this->db->prepare("SELECT count(pareja) FROM PAREJA WHERE pareja = ? AND idCampeonato = ?");

    $stmt->execute(array($pareja, $idCampeonato));    

    if($sql->fetchColumn() > 0 || $stmt->fetchColumn() > 0){

      return true;
    }else{
      return false;
    
    }

  }

}
 ?>
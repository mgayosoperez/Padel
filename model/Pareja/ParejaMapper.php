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

  public function grupo($categoria,$nivel,$campeonato){
    $sql = $this->db->prepare("SELECT * FROM PAREJA WHERE categoria = ? AND nivel = ? AND idCampeonato= ?");
    $sql->execute(array($categoria, $nivel, $campeonato));
    $grupo = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $grupo;
  }

  public function modify(Pareja $pareja){
    $sql = $this->db->prepare("UPDATE PAREJA SET pareja = ?, categoria = ?, nivel = ?, grupo = ?, puntos = ? WHERE  idCampeonato = ? AND capitan = ?");
    $sql->execute(array($pareja->getPareja(),$pareja->getCategoria(),$pareja->getNivel(),$pareja->getGrupo(),$pareja->getPuntos(),$pareja->getIdCampeonato(),$pareja->getCapitan()));
    $grupo = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $grupo;
  }

}
 ?>
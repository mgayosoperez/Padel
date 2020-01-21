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

  public function showAll($idCampeonato){
    $sql = $this->db->prepare("SELECT * FROM PAREJA WHERE  idCampeonato= ?");
    $sql->execute(array($idCampeonato));
    $grupo = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $grupo;
  }

  public function ultimoGrupo($idCampeonato){
    $sql = $this->db->prepare("SELECT MAX(grupo) FROM PAREJA WHERE  idCampeonato= ?");
    $sql->execute(array($idCampeonato));
    $grupo = $sql->fetch(PDO::FETCH_ASSOC);
    $toret="0";
    if($grupo!=NULL){
      foreach ($grupo as $key) {
        $toret= $key;
      }
    }
    return $toret;
  }

  public function numGrupos($idCampeonato){
    $sql = $this->db->prepare("SELECT COUNT(DISTINCT grupo) FROM PAREJA WHERE  idCampeonato= ?");
    $sql->execute(array($idCampeonato));
    $grupo = $sql->fetch(PDO::FETCH_ASSOC);
    $toret="0";
    if($grupo!=NULL){
      foreach ($grupo as $key) {
        $toret= $key;
      }
    }
    return $toret;
  }

  public function parejasGrupo($idGrupo){
      $sql = $this->db->prepare("SELECT pareja.capitan, pareja.pareja, pareja.puntos, pareja.idCampeonato FROM pareja WHERE pareja.grupo=?;");
      $sql->execute(array($idGrupo));
      $parejas = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $parejas;
  }

  public function añadirPuntos($capitan, $idCampeonato, $cantidad){
    $sql = $this->db->prepare("UPDATE abp.pareja SET pareja.puntos=? WHERE pareja.capitan=? AND pareja.idCampeonato=?;");
    $sql->execute(array($cantidad,$capitan,$idCampeonato));
    return true;
  }

  public function cogerOchoParejas($idCampeonato,$idGrupo){
    $sql = $this->db->prepare("SELECT * FROM abp.pareja WHERE pareja.idCampeonato = ? AND pareja.grupo = ? ORDER BY pareja.puntos DESC LIMIT 8;");
    $sql->execute(array($idCampeonato, $idGrupo));

    $parejas = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $parejas;
  }
}
 ?>
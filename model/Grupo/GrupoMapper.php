<?php
require_once(__DIR__."/../../core/PDOConnection.php");

class GrupoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add($idLiga){
    
    $sql = $this->db->prepare("INSERT INTO Grupo (idLiga) 
                                VALUES (?)");
    $sql->execute(array($idLiga));
    $auxiliar =  $this->db->lastInsertId();
    return  $auxiliar;
  }

  public function getGruposLiga($idLiga){
    $sql = $this->db->prepare("SELECT grupo.idGrupo FROM abp.grupo WHERE grupo.idLiga=?;");
    $sql->execute(array($idLiga));
    $grupos = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $grupos;

  }

  public function update($idGrupo, $idPlayOff){
    $sql = $this->db->prepare("UPDATE abp.grupo SET grupo.idPlayoffs = ? WHERE grupo.idGrupo=?;");
    $sql->execute(array($idPlayOff ,$idGrupo));
  }



}
 ?>
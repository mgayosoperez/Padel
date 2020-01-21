<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/PlayOffs/PlayOffs.php");

require_once(__DIR__."/../../model/Pareja/Pareja.php");
require_once(__DIR__."/../../model/Pareja/ParejaMapper.php");


class PlayOffsMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();

    $this->ParejaMapper = new ParejaMapper();
  }

  public function add($fechaInicio, $fechaFin, $categoria, $nivel, $idCampeonato){
        $sql = $this->db->prepare("INSERT INTO playoffs (fechaInicio, fechaFin, categoria, nivel, idCampeonato) 
                                VALUES (?,?,?,?,?)");

    $sql->execute(array($fechaInicio, $fechaFin, $categoria, $nivel, $idCampeonato));

    $auxiliar =  $this->db->lastInsertId();
    return  $auxiliar;
  }

  public function añadirParejas($idCapitan, $idPlayoffs){
    $sql = $this->db->prepare("INSERT INTO playoffs_fase_grupo (idPlayoff, capitan) VALUES (?,?)");
    $sql->execute(array($idPlayoffs, $idCapitan));
  }

  public function existe($idCampeonato){
    $sql = $this->db->prepare("SELECT count(idPlayoffs) FROM abp.playoffs WHERE playoffs.idCampeonato = ?;");
    $sql->execute(array($idCampeonato));
    if ($sql->fetchColumn() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function getParejas($idPlayoff){
    $sql = $this->db->prepare("SELECT * FROM abp.playoffs_fase_grupo WHERE playoffs_fase_grupo.idPlayoff = ?;");
    $sql->execute(array($idPlayoff));
    $parejas = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $parejas;
  }

  public function getIdPlayOffs($idC){
    $sql = $this->db->prepare("SELECT idPlayoffs FROM abp.playoffs WHERE playoffs.idCampeonato = ?;");
    $sql->execute(array($idC));
    $parejas = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $parejas;
  }

  public function updateGanador($fase,$capitan, $idPlayoff){
    $sql = $this->db->prepare("UPDATE abp.playoffs_fase_grupo SET playoffs_fase_grupo.fase = ? WHERE playoffs_fase_grupo.idPlayoff=? AND playoffs_fase_grupo.capitan=?;");
    $sql->execute(array($fase, $idPlayoff, $capitan));
  }

}
 ?>
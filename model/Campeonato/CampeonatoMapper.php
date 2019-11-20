<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Campeonato/Campeonato.php");

class CampeonatoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Campeonato $campeonato){
    $sql = $this->db->prepare("INSERT INTO CAMPEONATO(nombre, fechaInicio, fechaFin) VALUES (?,?,?)");
    $sql->execute(array($campeonato->getNombre(), $campeonato->getFechaInicio(), $campeonato->getFechaFin()));   
  }

  public function delete($campeonato){
    $sql = $this->db->prepare("DELETE FROM Campeonato WHERE idCampeonato = ?");
    $sql->execute(array($campeonato));
  }

  public function campeonatoActivo(){
    $sql = $this->db->prepare("SELECT * FROM campeonato WHERE ? BETWEEN campeonato.fechaInicio AND campeonato.fechaFin");
    $fecha = date("Y-m-d H:i" ,time());
    $sql->execute(array($fecha));

    $campeonato = $sql->fetchAll(PDO::FETCH_ASSOC);

     return $campeonato;
  }

}
 ?>
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



}
 ?>
<?php
require_once(__DIR__."/../core/PDOConnection.php");

class CampeonatoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Campeonato $campeonato){
    $sql = $this->db->prepare("INSERT INTO CAMPEONATO(idCampeonato, nombre, fechaInicio, fechaFin)
                                VALUES (?,?,?,?)");
    $sql->execute(array($campeonato->getIdCampeonato(), $campeonato->getNombre(), $campeonato->getFechaInicio(), $campeonato->getFechaFin()));
    
    if(!$this->mysqli->query($sql)){
    	return 'Error en la inserción';
    }				
    else{
    	return 'Inserción realizada con éxito';
    }

  }

  public function delete(Campeonato $campeonato){
    $sql = $this->db->prepare("DELETE FROM Campeonato WHERE idCampeonato = ?");

    $sql->execute(array($campeonato->getIdCampeonato()));

    if ($this->mysqli->query($sql)) {
            
        return "Borrado realizado con exito";
        
    } else {
        return "Error en el borrado";
    }
  }
}
 ?>
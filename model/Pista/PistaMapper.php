<?php
require_once(__DIR__."/../core/PDOConnection.php");

class PistaMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Pista $pista){
    $sql = $this->db->prepare("INSERT INTO Pista(idPista, estado, superficie)
                                VALUES (?,?,?)");
    $sql->execute(array($pista->getIdPista(), $pista->getEstado(), $pista->getSuperficie()));
    
    if(!$this->mysqli->query($sql)){
    	return 'Error en la inserción';
    }				
    else{
    	return 'Inserción realizada con éxito';
    }

  }

  public function delete(Pista $pista){
    $sql = $this->db->prepare("DELETE FROM Pista WHERE idPista = ?");

    $sql->execute(array($pista->getIdPista()));

    if ($this->mysqli->query($sql)) {
            
        return "Borrado realizado con exito";
        
    } else {
        return "Error en el borrado";
    }
  }
}
 ?>
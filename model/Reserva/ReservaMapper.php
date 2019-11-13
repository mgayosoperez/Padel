<?php
require_once(__DIR__."/../core/PDOConnection.php");

class ReservaMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Reserva $reserva){
    $sql = $this->db->prepare("INSERT INTO RESERVA(idReserva, fecha, idPista)
                                VALUES (?,?,?)");
    $sql->execute(array($reserva->getIdReserva(), $reserva->getFecha(), $reserva->getIdPista()));
    
    if(!$this->mysqli->query($sql)){
    	return 'Error en la inserción';
    }				
    else{
    	return 'Inserción realizada con éxito';
    }

  }

  public function delete(Reserva $reserva){
    $sql = $this->db->prepare("DELETE FROM RESERVA WHERE idReserva = ?");

    $sql->execute(array($reserva->getIdReserva()));

    if ($this->mysqli->query($sql)) {
            
        return "Borrado realizado con exito";
        
    } else {
        return "Error en el borrado";
    }
  }
}
 ?>
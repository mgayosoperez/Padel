<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

class ReservaMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Reserva $reserva){
    $sql = $this->db->prepare("INSERT INTO RESERVA(idReserva, fecha, idPista)
                                VALUES (?,?,?)");
    $sql->execute(array($reserva->getIdReserva(), $reserva->getFecha(), $reserva->getIdPista()));

    $auxiliar =  $this->db->lastInsertId();




    $sql = $this->db->prepare("INSERT INTO RESERVA_HAS_DEPORTISTA(idReserva, idDeportista)
                                VALUES (?,?)");
    $sql->execute(array($auxiliar, $_SESSION["currentuser"]));


  }

  public function addClase(Reserva $reserva){
    $sql = $this->db->prepare("INSERT INTO RESERVA(fecha, idPista)
                                VALUES (?,?)");
    $sql->execute(array($reserva->getFecha(), $reserva->getIdPista()));

    $auxiliar =  $this->db->lastInsertId();

    return $auxiliar;

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

  public function getHasReserva($id){
     $sql = $this->db->prepare("SELECT reserva.idReserva FROM reserva, reserva_has_deportista WHERE reserva.idReserva = reserva_has_deportista.idReserva AND reserva.fecha > ? AND reserva_has_deportista.idDeportista =?");
  	 $fecha = date("Y-m-d H:i" ,time());
     $sql->execute(array($fecha,$id));

  	 $reserva = $sql->fetchAll(PDO::FETCH_ASSOC);

  	 $toret = array();

  	foreach ($reserva as $re) {
			array_push($toret, $re["idReserva"]);
		}


  	 return $toret;

 	}
 	public function getReserva($id){
 		$sql = $this->db->prepare("SELECT * FROM RESERVA WHERE idReserva = ?");
 		$sql->execute(array($id));
 		$reserva = $sql->fetch(PDO::FETCH_ASSOC);
 		if($reserva != null) {
 			return $reserva;
			//return $arrayName = array('fecha' =>$reserva["fecha"] ,'pista'=> $reserva["idPista"] );
		} else {
			return NULL;
		}
 	}

 	public function numReserva($id){
 		$sql = $this->db->prepare("SELECT count(reserva.idReserva) FROM reserva, reserva_has_deportista WHERE reserva.idReserva = reserva_has_deportista.idReserva AND reserva.fecha > ? AND reserva_has_deportista.idDeportista =?");
    $fecha = date("Y-m-d H:i" ,time());
 		$sql->execute(array($fecha,$id));
 		$toret="0";
 		$numReserva = $sql->fetch(PDO::FETCH_ASSOC);
 		if($numReserva!=NULL){
 			foreach ($numReserva as $key) {
				$toret= $key;
			}
		}
 		return $toret;

 	}

 	public function pistasOcupadas($fecha){
 		$sql = $this->db->prepare("SELECT count(fecha) FROM RESERVA WHERE fecha = ?");
 		$sql->execute(array($fecha));
 		$toret="";
 		$reservasFecha = $sql->fetch(PDO::FETCH_ASSOC);
 		foreach ($reservasFecha as $key) {
			$toret= $key;
		}
 		return $toret;

 	}



}
 ?>

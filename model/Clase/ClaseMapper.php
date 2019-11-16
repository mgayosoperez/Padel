<?php
require_once(__DIR__."/../../core/PDOConnection.php");

class ClaseMapper{

  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function findAll(){
    $stmt = $this->db->query("SELECT * from CLASE");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {

      array_push($clases, new Clase($clase["idclase"], $clase["maxAlumnos"],
                $clase["login"], $clase["reserva"]));
    }

    return $clases;
  }
  public function findAllById($loginEntrenador){
    $stmt = $this->db->query("SELECT * from CLASE WHERE login= '$loginEntrenador'");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {

      array_push($clases, new Clase($clase["idclase"], $clase["maxAlumnos"],
                $clase["login"], $clase["reserva"]));
    }

    return $clases;
  }


  public function crear(Clase $clase){
    $stmt = $this->db->prepare("INSERT INTO CLASE(maxAlumnos, login) values (?, ?)");
		$stmt->execute(array($clase->getMaxAlum(),$clase->getLogin()));

      if(!$this->db->query($stmt)){

        return 'Error en la inserción';
      }
      else{
        return 'Inserción realizada con éxito';
      }
  }

  public function delete(Clase $clase) {
    $stmt = $this->db->prepare("DELETE from CLASE WHERE idClase=?");
    $stmt->execute(array($clase->getIdClase()));

    if ($this->db->query($stmt)) {

        return "Borrado realizado con exito";

    } else {
        return "Error en el borrado";
    }
  }



  public function existeClaseReserva($reserva){
    $stmt = $this->db->prepare("SELECT count(hora) from CLASE WHERE hora = ?");
    $stmt->execute(array($reserva));

    if ($stmt->fetchColumn > 0) {
      return true;
    }else{
      return false;
    }
  }

  public function existeClaseId($idClase){
    $stmt = $this->db->prepare("SELECT count(idClase) from CLASE WHERE idClase = ?");
    $stmt->execute(array($idClase));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  public function inscribir($idClase, $deportista){
    $stmt = $this->db->prepare("INSERT INTO DEPORTISTA_HAS_CLASE VALUES(?, ?)");
    $stmt->execute(array($idClase, $deportista));
  }


}

 ?>

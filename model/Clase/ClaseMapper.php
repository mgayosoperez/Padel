<?php
require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Clase/ClaseGrupal.php");

class ClaseMapper{

  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function findAllGrupales(){
    $stmt = $this->db->query("SELECT * from CLASE_GRUPAL");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {
      $claseGrupal = new ClaseGrupal();
      $stmt2 = $this->db->query("SELECT login, reserva from CLASE WHERE idClase = $clase[idClase]");
      $row = $stmt2->fetch();
      $claseGrupal->setIdClase($clase["idClase"]);
      $claseGrupal->setMaxAlum($clase["maxAlumnos"]);
      $claseGrupal->setDescripcion($clase["descripcion"]);
      $claseGrupal->setLogin($row["login"]);
      $claseGrupal->setReserva($row["reserva"]);
      array_push($clases, $claseGrupal);
    }

    return $clases;
  }
  public function findAllParticulares(){
    $stmt = $this->db->query("SELECT * from CLASE WHERE CLASE.rol = 'PARTICULAR'");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {

      array_push($clases, new Clase($clase["idClase"], $clase["login"],
                $clase["rol"], $clase["reserva"]));
    }

    return $clases;
  }



  public function findAllById($loginEntrenador){
    $stmt = $this->db->query("SELECT * from CLASE WHERE login= '$loginEntrenador'");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {

      array_push($clases, new Clase($clase["idClase"], $clase["login"],
                $clase["rol"], $clase["reserva"]));
    }

    return $clases;
  }
  public function misClasesGrupales($loginDeportista){
    $stmt = $this->db->query("SELECT * from CLASE_GRUPAL, DEPORTISTA_HAS_CLASE_GRUPAL WHERE Clase_Grupal.idClase = DEPORTISTA_HAS_CLASE_GRUPAL.idClase AND DEPORTISTA_HAS_CLASE_GRUPAL.login = '$loginDeportista' ");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {
      array_push($clases, $clase["idClase"]);
    }

    return $clases;
  }
  public function misClasesParticulares($loginDeportista){
    $stmt = $this->db->query("SELECT * from CLASE, CLASE_PARTICULAR WHERE CLASE.idClase = CLASE_PARTICULAR.idClase AND CLASE_PARTICULAR.deportista = '$loginDeportista' ");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clases = array();
    foreach ($clases_db as $clase) {

      array_push($clases, new Clase($clase["idClase"], $clase["login"],
                $clase["rol"], $clase["reserva"]));
    }

    return $clases;
  }


  public function crear(Clase $clase){
    $stmt = $this->db->prepare("INSERT INTO CLASE(rol, login, reserva) values (?, ?, ?)");
		$stmt->execute(array($clase->getRol(),$clase->getLogin(), $clase->getReserva()));

        return $this->db->lastInsertId();
  }

  public function crearGrupal($idClase, $maxAlumnos, $descripcion){
    $stmt = $this->db->prepare("INSERT INTO CLASE_GRUPAL(idClase, maxAlumnos, descripcion) values (?, ?, ?)");
    $stmt->execute(array($idClase ,$maxAlumnos, $descripcion));

      if(!$this->db->query($stmt)){

        return 'Error en la inserción';
      }
      else{
        return 'Inserción realizada con éxito';
      }
  }

  public function crearParticular($idClase, $deportista){
    $stmt = $this->db->prepare("INSERT INTO CLASE_PARTICULAR(idClase, deportista, aceptar) values (?,?,?)");
    $stmt->execute(array($idClase, $deportista, FALSE));

  }

  public function delete(Clase $clase) {
    $stmt = $this->db->prepare("DELETE from CLASE WHERE idClase=?");
    $stmt->execute(array($clase->getIdClase()));
    $sql = $this->db->prepare("DELETE from RESERVA WHERE idReserva = ?");
    $sql->execute(array($clase->getReserva()));

    if ($this->db->query($stmt) && $this->db->query($sql)) {

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

  public function existeParticular($idClase){
    $stmt = $this->db->prepare("SELECT count(idClase) from CLASE_PARTICULAR WHERE idClase = ?");
    $stmt->execute(array($idClase));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }


  public function inscribirGrupal($idClase, $deportista){
    $stmt = $this->db->prepare("INSERT INTO DEPORTISTA_HAS_CLASE_GRUPAL(idClase, login) VALUES (?, ?)");
    $stmt->execute(array($idClase, $deportista));

    if(!$this->db->query($stmt)){

      return 'Error en la inserción';
    }
    else{
      return 'Inserción realizada con éxito';
    }
  }
  public function inscribirParticular($idClase, $deportista){
    $stmt = $this->db->prepare("INSERT INTO CLASE_PARTICULAR(idClase, deportista, aceptar) VALUES(?, ?, ?)");
    $stmt->execute(array($idClase, $deportista, FALSE));

    if(!$this->db->query($stmt)){

      return 'Error en la inserción';
    }
    else{
      return 'Inserción realizada con éxito';
    }
  }

  public function desinscribirGrupal($idClase, $deportista){
      $stmt = $this->db->prepare("DELETE FROM DEPORTISTA_HAS_CLASE_GRUPAL WHERE idClase = ? AND login = ?");
      $stmt->execute(array($idClase, $deportista));
      if ($this->db->query($stmt)) {

          return "Borrado realizado con exito";

      } else {
          return "Error en el borrado";
      }

  }
  public function desinscribirParticular($idClase, $deportista, $reserva){
      $stmt = $this->db->prepare("DELETE FROM CLASE_PARTICULAR WHERE idClase = ? AND deportista = ?");
      $stmt->execute(array($idClase, $deportista));
      $sql = $this->db->prepare("DELETE from RESERVA WHERE idReserva = ?");
      $sql->execute(array($reserva));
      if ($this->db->query($stmt) && $this->db->query($sql)) {

          return "Borrado realizado con exito";

      } else {
          return "Error en el borrado";
      }


  }


  public function getClase($idClase){
    $stmt = $this->db->prepare("SELECT * FROM CLASE WHERE idClase = ?");
    $stmt->execute(array($idClase));

    return $stmt->fetch();
  }
  public function getClaseGrupal($idClase){
    $stmt = $this->db->prepare("SELECT * FROM CLASE_GRUPAL WHERE idClase = ?");
    $stmt->execute(array($idClase));

    return $stmt->fetch();
  }
  public function getClaseParticular($idClase){
    $stmt = $this->db->prepare("SELECT * FROM CLASE_PARTICULAR WHERE idClase = ?");
    $stmt->execute(array($idClase));

    return $stmt->fetch();
  }
  public function getNumAlum($idClase){
    $stmt = $this->db->prepare("SELECT count(login) FROM DEPORTISTA_HAS_CLASE_GRUPAL WHERE idClase = ?");
    $stmt->execute(array($idClase));
    $numAlum = $stmt->fetch(PDO::FETCH_ASSOC);
 		foreach ($numAlum as $key) {
			$toret= $key;
		}
    return $toret;
  }
  public function existeClase($fecha){
    $stmt = $this->db->prepare("SELECT count(idClase) from CLASE, RESERVA WHERE reserva = RESERVA.idReserva AND RESERVA.fecha = ? ");
    $stmt->execute(array($fecha));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }
  public function entrenadorHasClase($fecha, $entrenador){ //Comprueba si el entrenador tiene clase a esa hora
    $stmt = $this->db->prepare("SELECT count(idClase) from CLASE, RESERVA WHERE reserva = RESERVA.idReserva AND RESERVA.fecha = ?  AND CLASE.login = ?");
    $stmt->execute(array($fecha, $entrenador));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  public function aceptarClase($idClase){
    $stmt = $this->db->prepare("UPDATE CLASE_PARTICULAR SET aceptar = ? WHERE idClase = ?");
    $stmt->execute(array(TRUE ,$idClase));
  }


}

 ?>

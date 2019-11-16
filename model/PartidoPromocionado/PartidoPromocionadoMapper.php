<?php
require_once(__DIR__."/../../core/PDOConnection.php");


class PartidoPromocionadoMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function findAll(){
    $stmt = $this->db->query("SELECT * FROM partido_promocionado");

    $pPromocionados_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pPromocionados = array();
    foreach ($pPromocionados_db as $pPromocionado) {

      array_push($pPromocionados, new PartidoPromocionado($pPromocionado["idPromocionado"], $pPromocionado["fecha"],
                $pPromocionado["idReserva"], $pPromocionado["numDeportista"]));
    }/*
    while($row = $stmt->fetch_object()){
      $entrenadores[] = $row;
    }*/
    return $pPromocionados;
  }

  public function add(PartidoPromocionado $partido){
    $stmt = $this->db->prepare("INSERT INTO partido_promocionado(fecha, numDeportista)
                                values (?,?)");

    $stmt->execute(array($partido->getFecha(), $partido->getNumDeportista()));

    if(!$this->db->query($stmt)){

      return 'Error en la inserción';
    }
    else{
      return 'Inserción realizada con éxito';
    }
  }

  public function delete(PartidoPromocionado $partido){
    $stmt = $this->db->prepare("DELETE from partido_promocionado WHERE idPromocionado=?");
    $stmt->execute(array($partido->getIdPromocionado()));

    if ($this->db->query($stmt)) {

        return "Borrado realizado con exito";

    } else {
        return "Error en el borrado";
    }
  }


  public function update(Entrenador $entrenador){
    $stmt = $this->db->prepare("UPDATE ENTRENADOR SET
                              password = ?, DNI = ?,
                              NSS = ?, nombre = ?,
                              apellidos = ?, sexo = ? WHERE login =?");

    $stmt->execute(array($entrenador->getPasswd(),
                    $entrenador->getDni(), $entrenador->getNss(),
                    $entrenador->getNombre(),$entrenador->getApellidos(),
                    $entrenador->getSexo(), $entrenador->getLogin()));
  }



  public function existePromocionado($idPromocionado) {
		$stmt = $this->db->prepare("SELECT count(idPromocionado) FROM partido_promocionado where idPromocionado=?");
		$stmt->execute(array($idPromocionado));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
  }

  public function findByUsername($username) {
    $stmt = $this->db->prepare("SELECT * FROM ENTRENADOR where login=?");
		$stmt->execute(array($username));
    $entrenador = $stmt->fetch(PDO::FETCH_ASSOC);
    $toret = new Entrenador($entrenador["login"], $entrenador["password"],
              $entrenador["DNI"], $entrenador["NSS"], $entrenador["nombre"], $entrenador["apellidos"],
              $entrenador["sexo"]);

    return $toret;
  }




}
 ?>

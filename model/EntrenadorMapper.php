<?php
require_once(__DIR__."/../core/PDOConnection.php");


class EntrenadorMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function findAll(){
    $stmt = $this->db->query("SELECT * FROM ENTRENADOR");
    $entrenadores_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $entrenadores = array();
    foreach ($entrenadores_db as $entrenador) {

      array_push($entrenadores, new Entrenador($entrenador["login"], $entrenador["password"],
                $entrenador["DNI"], $entrenador["NSS"], $entrenador["nombre"], $entrenador["apellidos"],
                $entrenador["sexo"], $entrenador["clase"]));
    }
    return $entrenadores;
  }

  public function add(Entrenador $entrenador){
    $stmt = $this->db->prepare("INSERT INTO ENTRENADOR(login, password, DNI, NSS,
                                nombre, apellidos, sexo, clase)
                                values (?,?,?,?,?,?,?,?)");

    $stmt->execute(array($entrenador->getLogin(), $entrenador->getPasswd(),
                          $entrenador->getDni(), $entrenador->getNss(),
                          $entrenador->getNombre(),$entrenador->getApellidos(),
                          $entrenador->getSexo(), $entrenador->getClase()));
    return $this->db->lastInsertId();
  }

  public function delete(Entrenador $entrenador){
    $stmt = $this->db->prepare("DELETE from ENTRENADOR WHERE login=?");
    $stmt->execute(array($entrenador->getLogin()));
  }


  public function update(Entrenador $entrenador){
    $stmt = $this->db->prepare("UPDATE ENTRENADOR SET login = ?,
                              password = ?, DNI = ?,
                              NSS = ?, nombre = ?,
                              apellidos = ?, sexo = ?,
                              clase = ?");

    $stmt->execute(array($entrenador->getLogin(), $entrenador->getPasswd(),
                    $entrenador->getDni(), $entrenador->getNss(),
                    $entrenador->getNombre(),$entrenador->getApellidos(),
                    $entrenador->getSexo(), $entrenador->getClase()));
  }



  public function entrenadorExiste($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM ENTRENADOR where login=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
  }

  public function findByUsername($username) {
    $stmt = $this->db->prepare("SELECT * FROM ENTRENADOR where login=?");
		$stmt->execute(array($username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }




}
 ?>

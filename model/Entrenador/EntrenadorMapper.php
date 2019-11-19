<?php
require_once(__DIR__."/../../core/PDOConnection.php");


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
                $entrenador["sexo"]));
    }/*
    while($row = $stmt->fetch_object()){
      $entrenadores[] = $row;
    }*/
    return $entrenadores;
  }

  public function add(Entrenador $entrenador){
    $stmt = $this->db->prepare("INSERT INTO ENTRENADOR(login, password, DNI, NSS,
                                nombre, apellidos, sexo)
                                values (?,?,?,?,?,?,?)");

    $stmt->execute(array($entrenador->getLogin(), $entrenador->getPasswd(),
                          $entrenador->getDni(), $entrenador->getNss(),
                          $entrenador->getNombre(),$entrenador->getApellidos(),
                          $entrenador->getSexo()));

    if(!$this->db->query($stmt)){

      return 'Error en la inserción';
    }
    else{
      return 'Inserción realizada con éxito';
    }
  }

  public function delete(Entrenador $entrenador){
    $stmt = $this->db->prepare("DELETE from ENTRENADOR WHERE login=?");
    $stmt->execute(array($entrenador->getLogin()));

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



  public function entrenadorExiste($login) {
		$stmt = $this->db->prepare("SELECT count(login) FROM ENTRENADOR where login=?");
		$stmt->execute(array($login));

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

  public function isValidEntrenador($login, $passwd) {
    $stmt = $this->db->prepare("SELECT count(login) FROM ENTRENADOR where login=? and password=?");
    $stmt->execute(array($login, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }




}
 ?>

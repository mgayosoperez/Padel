<?php
require_once(__DIR__."/../core/PDOConnection.php");

class EntrenadorMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
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
/*
  public function update(Entrenador $entrenador){
    $stmt = $this->db->prepare("UPDATE ENTRENADOR SET login = $entrenador->getLogin() , password = $entrenador->getPasswd(), DNI, NSS, nombre, apellidos, sexo, clase")
  }*/


}
 ?>

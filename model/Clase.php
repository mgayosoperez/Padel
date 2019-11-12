<?php
/**
 *
 */

 require_once(__DIR__."/../core/ValidationException.php");


class Clase{

  private $idClase;
  private $numAlum;
  private $hora;
  private $login;


  function __construct($idClase = NULL, $numAlum = NULL, $hora = NULL, $login = NULL){
    $this->idClase = $idClase;
    $this->numAlum = $numAlum;
    $this->hora = $hora;
    $this->login = $login;
  }

//Getters
  public function getIdClase(){
    return $this->idClase;
  }
  public function getNumAlum(){
    return $this->numAlum;
  }
  public function getHora(){
    return $this->hora;
  }
  public function getLogin(){
    return $this->login;
  }

//Setters
  public function setIdClase($idClase){
    $this->idClase = $idClase;
  }
  public function setNumAlum($numAlum){
    $this->numAlum = $numAlum;
  }
  public function setHora($hora){
    $this->hora = $numAlum;
  }
  public function setLogin($login){
    $this->login = $login;
  }



}

 ?>

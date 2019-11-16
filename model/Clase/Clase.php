<?php
 require_once(__DIR__."/../../core/ValidationException.php");


class Clase{

  private $idClase;
  private $maxAlum;
  private $reserva;
  private $login;


  function __construct($idClase = NULL, $maxAlum = NULL, $login = NULL, $reserva = NULL){
    $this->idClase = $idClase;
    $this->maxAlum = $maxAlum;
    $this->reserva = $reserva;
    $this->login = $login;
  }

//Getters
  public function getIdClase(){
    return $this->idClase;
  }
  public function getMaxAlum(){
    return $this->maxAlum;
  }
  public function getReserva(){
    return $this->reserva;
  }
  public function getLogin(){
    return $this->login;
  }

//Setters
  public function setIdClase($idClase){
    $this->idClase = $idClase;
  }
  public function setMaxAlum($maxAlum){
    $this->maxAlum = $maxAlum;
  }
  public function setReserva($reserva){
    $this->reserva = $reserva;
  }
  public function setLogin($login){
    $this->login = $login;
  }



}

 ?>

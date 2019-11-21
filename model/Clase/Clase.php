<?php
 require_once(__DIR__."/../../core/ValidationException.php");


class Clase{

  private $idClase;
  private $maxAlum;
  private $reserva;
  private $login;
  private $fecha;
  private $descripcion;
  private $aceptar;


  function __construct($idClase = NULL, $login = NULL, $rol = NULL, $reserva = NULL){
    $this->idClase = $idClase;
    $this->login = $login;
    $this->rol = $rol;
    $this->reserva = $reserva;

  }

//Getters
  public function getIdClase(){
    return $this->idClase;
  }
  public function getLogin(){
    return $this->login;
  }
  public function getRol(){
    return $this->rol;
  }
  public function getReserva(){
    return $this->reserva;
  }
  public function getFecha(){
    return $this->fecha;
  }
  public function getDescripcion(){
    return $this->descripcion;
  }
  public function getAceptar(){
    return $this->aceptar;
  }


//Setters
  public function setIdClase($idClase){
    $this->idClase = $idClase;
  }
  public function setLogin($login){
    $this->login = $login;
  }
  public function setRol($rol){
    $this->rol = $rol;
  }
  public function setReserva($reserva){
    $this->reserva = $reserva;
  }
  public function setFecha($fecha){
    $this->fecha = $fecha;
  }
  public function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
  }
  public function setAceptar($aceptar){
    $this->aceptar = $aceptar;
  }





}

 ?>

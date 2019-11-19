<?php
 require_once(__DIR__."/../../core/ValidationException.php");


class PartidoPromocionado{

  private $idPromocionado;
  private $fecha;
  private $reserva;
  


  function __construct($idPromocionado = "", $fecha = "", $reserva = ""){
    $this->idPromocionado = $idPromocionado;
    $this->fecha = $fecha;
    $this->reserva = $reserva;
  }

  //Getters
    public function getIdPromocionado(){
      return $this->idPromocionado;
    }
    public function getFecha(){
      return $this->fecha;
    }
    public function getReserva(){
      return $this->reserva;
    }

  //Setters
    public function setIdPromocionado($idPromocionado){
      $this->idPromocionado = $idPromocionado;
    }
    public function setFecha($fecha){
      $this->fecha = $fecha;
    }
    public function setReserva($reserva){
      $this->reserva = $reserva;
    }
    
}

<?php
 require_once(__DIR__."/../../core/ValidationException.php");


class PartidoPromocionado{

  private $idPromocionado;
  private $fecha;
  private $reserva;
  private $numDeportista;


  function __construct($idPromocionado = NULL, $fecha = NULL, $reserva = NULL, $numDeportista = NULL){
    $this->idPromocionado = $idPromocionado;
    $this->fecha = $fecha;
    $this->reserva = $reserva;
    $this->numDeportista = $numDeportista;
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
    public function getNumDeportista(){
      return $this->numDeportista;
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
    public function setNumDeportista($numDeportista){
      $this->numDeportista = $numDeportista;
    }
}

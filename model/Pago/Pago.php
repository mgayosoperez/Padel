<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Pago {

  private $idFactura;
  private $fecha;
  private $importe;
  private $descripcion;
  private $deportista;
  private $pagado;

  function __construct($idFactura = NULL, $fecha = NULL, $importe = NULL, $descripcion = NULL, $deportista = NULL, $pagado = NULL){
    $this->idFactura = $idFactura;
    $this->fecha = $fecha;
    $this->importe = $importe;
    $this->descripcion = $descripcion;
    $this->deportista = $deportista;
    $this->pagado = $pagado;
  }

  public function getIdFactura(){
    return $this->idFactura;
  }
  public function getFecha(){
    return $this->fecha;
  }
  public function getImporte(){
    return $this->importe;
  }
  public function getDescripcion(){
    return $this->descripcion;
  }
  public function getDeportista(){
    return $this->deportista;
  }
  public function getPagado(){
    return $this->pagado;
  }

  public function setIdFactura($idFactura){
    $this->idFactura = $idFactura;
  }
  public function setFecha($fecha){
    $this->fecha = $fecha;
  }
  public function setImporte($importe){
    $this->importe = $importe;
  }
  public function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
  }
  public function setPagado($pagado){
    $this->realizado = $realizado;
  }

}
?>

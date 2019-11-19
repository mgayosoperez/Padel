<?php
 require_once(__DIR__."/../../core/ValidationException.php");


class ClaseGrupal extends Clase{


  private $maxAlum;
  private $descripcion;


  function __construct($maxAlum = NULL, $descripcion = NULL){

    $this->descripcion = $descripcion;
    $this->maxAlum = $maxAlum;

  }

//Getters
  public function getMaxAlum(){
    return $this->maxAlum;
  }
  public function getDescripcion(){
    return $this->descripcion;
  }


//Setters
  public function setMaxAlum($maxAlum){
    $this->maxAlum = $maxAlum;
  }
  public function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
  }






}

 ?>

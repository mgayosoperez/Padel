<?php
require_once(__DIR__."/../../core/ValidationException.php");


class Campeonato{

  private $idCampeonato;
  private $nombre;
  private $fechaInicio;
  private $fechaFin;


  function __construct($idCampeonato = NULL, $nombre = NULL, $fechaInicio = NULL, $fechaFin = NULL){
    
    $this->idCampeonato = $idCampeonato;
    $this->nombre = $nombre;
    $this->fechaInicio = $fechaInicio;
    $this->fechaFin = $fechaFin;

 }


//GETTERS
 public function getIdCampeonato(){
   return $this->idCampeonato;
 }
 public function getNombre(){
   return $this->nombre;
 }
 public function getFechaInicio(){
   return $this->fechaInicio;
 }
 public function getFechaFin(){
   return $this->fechaFin;
 }

 //Setters
 public function setIdCampeonato($idCampeonato){
   $this->idCampeonato = $idCampeonato;
 }
 public function setNombre($nombre){
   $this->nombre = $nombre;
 }
 public function setFechaInicio($fechaInicio){
   $this->fechaInicio = $fechaInicio;
 }
 public function setFechaFin($fechaFin){
   $this->fechaFin = $fechaFin;
 }
  
}

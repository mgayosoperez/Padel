<?php
require_once(__DIR__."/../../core/ValidationException.php");


class LigaRegular{

  private $idLigaRegular;
  private $nombre;
  private $fechaInicio;
  private $fechaFin;
  private $categoria;
  private $nivel;
  private $idCampeonato;


  function __construct($idLigaRegular = NULL, $fechaInicio = NULL, $fechaFin = NULL, $categoria = NULL, $nivel = NULL, $idCampeonato=NULL){
    
    $this->idLigaRegular = $idLigaRegular;
    $this->fechaInicio = $fechaInicio;
    $this->fechaFin = $fechaFin;
    $this->categoria = $categoria;
    $this->nivel = $nivel;
    $this->idCampeonato = $idCampeonato;

 }


//GETTERS
 public function getIdLigaRegular(){
   return $this->idLigaRegular;
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
 public function getCategoria(){
   return $this->categoria;
 }
 public function getNivel(){
   return $this->nivel;
 }
 public function getIdCampeonato(){
  return $this->idCampeonato;
 }

 //Setters
 public function setIdLigaRegular($idLigaRegular){
   $this->idLigaRegular = $idLigaRegular;
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
 public function setCategoria($categoria){
   $this->categoria = $categoria;
 }
 public function setNivel($nivel){
   $this->nivel = $nivel;
 }
 public function setIdCampeonato($idCampeonato){
   $this->idCampeonato = $idCampeonato;
 }
  
}
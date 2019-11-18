<?php
require_once(__DIR__."/../../core/ValidationException.php");


class Pareja{

  private $capitan;
  private $pareja;
  private $idCampeonato;
  private $categoria;
  private $nivel;
  private $grupo;
  private $puntos;


  function __construct($capitan = NULL, $pareja = NULL, $idCampeonato = NULL, $categoria = NULL, $nivel = NULL, $grupo = NULL, $puntos = NULL){
    
    $this->capitan = $capitan;
    $this->pareja = $pareja;
    $this->idCampeonato = $idCampeonato;
    $this->categoria = $categoria;
    $this->nivel = $nivel;
    $this->grupo = $grupo;
    $this->puntos = $puntos;

 }


//GETTERS
 public function getCapitan(){
   return $this->capitan;
 }
 public function getPareja(){
   return $this->pareja;
 }
 public function getIdCampeonato(){
   return $this->idCampeonato;
 }
 public function getCategoria(){
   return $this->categoria;
 }
 public function getNivel(){
   return $this->nivel;
 }
 public function getGrupo(){
   return $this->grupo;
 }
 public function getPuntos(){
   return $this->puntos;
 }

 //Setters
 public function setCapitan($capitan){
   $this->capitan = $capitan;
 }
 public function setPareja($pareja){
   $this->pareja = $pareja;
 }
 public function setIdCampeonato($idCampeonato){
   $this->idCampeonato = $idCampeonato;
 }
 public function setCategoria($categoria){
   $this->categoria = $categoria;
 }
 public function setNivel($nivel){
   $this->nivel = $nivel;
 }
 public function setGrupo($grupo){
   $this->grupo = $grupo;
 }
 public function setPuntos($puntos){
   $this->puntos = $puntos;
 }

  
}

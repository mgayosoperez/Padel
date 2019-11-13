<?php
require_once(__DIR__."/../core/ValidationException.php");


class Entrenador{

 private $login;
 private $passwd;
 private $dni;
 private $nss;
 private $nombre;
 private $apellidos;
 private $sexo;
 private $clase;


 function __construct($login = NULL, $passwd = NULL, $dni = NULL, $nss = NULL,
                    $nombre = NULL, $apellidos = NULL, $sexo = NULL, $clase = NULL){
   $this->login = $login;
   $this->passwd = $passwd;
   $this->dni = $dni;
   $this->nss = $nss;
   $this->nombre = $nombre;
   $this->apellidos = $apellidos;
   $this->sexo = $sexo;
   $this->clase = $clase;
 }


//GETTERS
 public function getLogin(){
   return $this->login;
 }
 public function getPasswd(){
   return $this->passwd;
 }
 public function getDni(){
   return $this->dni;
 }
 public function getNss(){
   return $this->nss;
 }
 public function getNombre(){
   return $this->nombre;
 }
 public function getApellidos(){
   return $this->apellidos;
 }
 public function getSexo(){
   return $this->sexo;
 }
 public function getClase(){
   return $this->clase;
 }

 //Setters
 public function setLogin($login){
   $this->login = $login;
 }
 public function setPasswd($passwd){
   $this->passwd = $passwd;
 }
 public function setDni($dni){
   $this->dni = $dni;
 }
 public function setNss($nss){
   $this->nss = $nss;
 }
 public function setNombre($nombre){
   $this->nombre = $nombre;
 }
 public function setApellidos($apellidos){
   $this->apellidos = $apellidos;
 }
 public function setSexo($sexo){
   $this->sexo = $sexo;
 }
 public function setClase($clase){
   $this->clase = $clase;
 }

 public function checkIsValidForRegister() {
   $errors = array();
   if (strlen($this->username) < 5) {
     $errors["username"] = "Username must be at least 5 characters length";

   }
   if (strlen($this->passwd) < 5) {
     $errors["passwd"] = "Password must be at least 5 characters length";
   }
   if (strlen($this->name) < 5) {
     $errors["name"] = "Name must be at least 5 characters length";
   }
   if (strlen($this->email) < 5) {
     $errors["email"] = "Email must be at least 5 characters length";
   }
   if (strlen($this->phone) < 5) {
     $errors["phone"] = "Phone must be at least 5 characters length";
   }
   if (sizeof($errors)>0){
     throw new ValidationException($errors, "user is not valid");
   }
 }
}

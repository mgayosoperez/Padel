<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Deportista {

	private $login;
	private $passwd;
	private $dni;	
	private $nombre;
	private $apellidos;
	private $sexo;

	public function __construct($login = NULL, $passwd = NULL, $dni = NULL, $nombre = NULL, $apellidos = NULL, $sexo = NULL) {
		$this->login = $login;
		$this->passwd = $passwd;
		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->sexo = $sexo;
	}

	// geters
	public function getLogin() {
		return $this->login;
	}
	public function getPasswd() {
		return $this->passwd;
	}
	public function getDni() {
		return $this->dni;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getApellidos() {
		return $this->apellidos;
	}
	public function getSexo() {
		return $this->sexo;
	}

	// seters
	public function setLogin($login) {
		$this->login = $login;
	}
	public function setPassword($passwd) {
		$this->passwd = $passwd;
	}
	public function setDni($dni) {
		$this->dni = $dni;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;
	}
	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}

	
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->login) < 5) {
			$errors["Login"] = "Login must be at least 5 characters length";

		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (strlen($this->dni) < 5) {
			$errors["dni"] = "dni must be at least 5 characters length";
		}
		if (strlen($this->nombre) < 1) {
			$errors["nombre"] = "nombre must be at least 1 characters length";
		}
		if (strlen($this->apellidos) < 2) {
			$errors["apellidos"] = "apellidos must be at least 2 characters length";
		}
		if (strlen($this->sexo) < 4) {
			$errors["apellidos"] = "apellidos must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}

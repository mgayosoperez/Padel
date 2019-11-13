<?php

require_once(__DIR__."/../../core/PDOConnection.php");

class DeportistaMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save(Deportista $deportista) {
		$sql = $this->db->prepare("INSERT INTO DEPORTISTA (login, password, DNI, nombre, apellidos, sexo) values (?,?,?,?,?,?)");
		$sql->execute(array($deportista->getLogin(), $deportista->getPasswd(),
			$deportista->getDni(), $deportista->getNombre(), $deportista->getApellidos(), $deportista->getSexo()));
	}

	public function loginExists($login) {
		$stmt = $this->db->prepare("SELECT count(login) FROM DEPORTISTA where login=?");
		$stmt->execute(array($login));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}


	public function isValidDeportista($login, $passwd) {
		$stmt = $this->db->prepare("SELECT count(login) FROM DEPORTISTA where login=? and password=?");
		$stmt->execute(array($login, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}

<?php

require_once(__DIR__."/../../core/PDOConnection.php");

class AdminMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function isValidAdmin($login, $passwd) {
		$stmt = $this->db->prepare("SELECT count(login) FROM ADMIN where login=? and password=?");
		$stmt->execute(array($login, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}


}
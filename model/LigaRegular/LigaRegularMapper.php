<?php

require_once(__DIR__."/../../core/PDOConnection.php");

class LigaRegularMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function add(LigaRegular $ligaRegular) {
		$sql = $this->db->prepare("INSERT INTO liga_regular (fechaInicio, fechaFin, categoria, nivel, idCampeonato) values (?,?,?,?,?)");
		$sql->execute(array($ligaRegular->getfechaInicio(), $ligaRegular->getfechaFin(),
			$ligaRegular->getCategoria(), $ligaRegular->getNivel(), $ligaRegular->getIdCampeonato()));
		$auxiliar =  $this->db->lastInsertId();
    	return  $auxiliar;
	}


}

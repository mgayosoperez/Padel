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

	public function getLigaDeUnCampeonato($idCampeonato){
		$sql = $this->db->prepare("SELECT liga_regular.idLiga FROM abp.liga_regular WHERE liga_regular.idCampeonato=?;");
		$sql->execute(array($idCampeonato));
		$ligas = $sql->fetchAll(PDO::FETCH_ASSOC);
    	return $ligas;
	}

	public function getLiga($idLiga){
		$sql = $this->db->prepare("SELECT * FROM abp.liga_regular WHERE liga_regular.idLiga=?;");
		$sql->execute(array($idLiga));
		$liga = $sql->fetchAll(PDO::FETCH_ASSOC);
    	return $liga;
	}

	


}

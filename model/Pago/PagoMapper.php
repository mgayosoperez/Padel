<?php

require_once(__DIR__."/../../core/PDOConnection.php");
require_once(__DIR__."/../../model/Pago/Pago.php");

class PagoMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function facturas(){
		$stmt = $this->db->prepare("SELECT * FROM FACTURAS");
		$stmt->execute();
		$pagos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$pagos = array();
    foreach ($pagos_db as $pago) {

      array_push($pagos, new Pago($pago["idFactura"], $pago["fecha"],
                $pago["importe"], $pago["descripcion"], $pago["deportista"], $pago["pagado"]));
    }

    return $pagos;

	}

	public function facturasDeportista($loginDeportista){
		$stmt = $this->db->prepare("SELECT * FROM FACTURAS WHERE deportista = '$loginDeportista'");
		$stmt->execute();
		$pagos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$pagos = array();
    foreach ($pagos_db as $pago) {

      array_push($pagos, new Pago($pago["idFactura"], $pago["fecha"],
                $pago["importe"], $pago["descripcion"], $pago["deportista"], $pago["pagado"]));
    }

    return $pagos;
	}

	public function pagar($idFactura){
		$stmt = $this->db->prepare("UPDATE FACTURAS SET pagado = ? WHERE idFactura = ?");
		$stmt->execute(array(0, $idFactura));
	}

	public function addFactura($importe, $descripcion, $deportista){
		$stmt = $this->db->prepare("INSERT INTO FACTURAS(importe, fecha, descripcion, deportista, pagado) VALUES (?, NOW(), ?, ?, ?)");
		$stmt->execute(array($importe, $descripcion, $deportista, 1));
	}



}

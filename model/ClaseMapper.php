<?php
require_once(__DIR__."/../core/PDOConnection.php");

class ClaseMapper{

  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function crear(Clase $clase){
    $stmt = $this->db->prepare("INSERT INTO CLASE values (?,?,?,?)");
		$stmt->execute(array($clase->getIdClase(), $clase->getNumAlum(),
			$clase->getHora(), $clase->getLogin()));
  }

  public function delete(Clase $clase) {
    $stmt = $this->db->prepare("DELETE from CLASE WHERE idClase=?");
    $stmt->execute(array($clase->getIdClase()));
  }

  public function showall(){
    $stmt = $this->db->prepare("SELECT * from CLASE");
    $clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $clases = array();
    foreach ($clases_db as $clase) {
      array_push($clases, $clase);
    }
    return $clases;
  }
}

 ?>

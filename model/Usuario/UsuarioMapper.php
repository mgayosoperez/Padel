<?php
require_once(__DIR__."/../../core/PDOConnection.php");

class UsuarioMapper{

  private $db;

  function __construct(){
    $this->db = PDOConnection::getInstance();
  }

  public function add(Usuario $usuario){
    $sql = $this->db->prepare("INSERT INTO USUARIO (login, rol)
                                VALUES (?,?)");
    $sql->execute(array($usuario->getLogin(), $rol->getRol()));
    
    if(!$this->db->query($sql)){
    	return 'Error en la inserción';
    }				
    else{
    	return 'Inserción realizada con éxito';
    }

  }

  public function delete(Usuario $usuario){
    $sql = $this->db->prepare("DELETE FROM USUARIO WHERE login = ?");

    $sql->execute(array($usuario->getLogin()));

    if ($this->db->query($sql)) {
            
        return "Borrado realizado con exito";
        
    } else {
        return "Error en el borrado";
    }
  }

  public function checkRol($login){
    $sql = $this->db->prepare("SELECT rol FROM USUARIO WHERE login = ?");

    $sql->execute(array($login));

    $aux = $sql->fetchAll(PDO::FETCH_ASSOC);

  	$toret = array();

  	foreach ($aux as $re) {
			array_push($toret, $re["login"]);
		}


  	return $toret;

  }
}
 ?>
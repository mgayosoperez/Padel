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
    $sql->execute(array($usuario->getLogin(), $usuario->getRol()));
    
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

  	$toret = "";

  	$rol = $sql->fetch(PDO::FETCH_ASSOC);
    if($rol!=NULL){
      foreach ($rol as $key) {
        $toret= $key;
      }
    }


  	return $toret;

  }

    public function loginExists($login) {
    $stmt = $this->db->prepare("SELECT count(login) FROM USUARIO where login=?");
    $stmt->execute(array($login));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }
}
 ?>
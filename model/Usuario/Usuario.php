<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Usuario{

    private $login;
    private $rol;

    function __construct($login = NULL, $rol = NULL){

        $this->login = $login;
        $this->rol = $rol;
    }
}
// geters
public function getLogin()
{
    return $this->login;
}

public function getRol()
{
    return $this->rol;
}

// seters
public function setLogin($login)
{
    $this->login = $login;
}

public function setRol($rol)
{
    $this->rol = $rol;
}
?>
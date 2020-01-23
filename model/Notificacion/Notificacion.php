<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Notificacion{

    private $idNotificacion;
    private $emisor;
    private $destinatario;
    private $mensaje;
    private $new;

    function __construct($idNotificacion = NULL, $emisor = NULL, $destinatario = NULL, $mensaje = NULL, $new = NULL){

        $this->idNotificacion = $idNotificacion;
        $this->emisor = $emisor;
        $this->destinatario = $destinatario;
        $this->mensaje = $mensaje;
        $this->new = $new;
    }
    // geters
public function getIdNotificacion()
{
    return $this->idNotificacion;
}

public function getEmisor()
{
    return $this->emisor;
}

public function getDestinatario()
{
    return $this->destinatario;
}

public function getMensaje()
{
    return $this->mensaje;
}

public function getNew()
{
    return $this->new;
}

// seters
public function setIdNotificacion($idNotificacion)
{
    $this->idNotificacion = $idNotificacion;
}

public function setEmisor($emisor)
{
    $this->emisor = $emisor;
}

public function setDestinatario($destinatario)
{
    $this->destinatario = $destinatario;
}

public function setMensaje($mensaje)
{
    $this->mensaje = $mensaje;
}

public function setNew($new)
{
    $this->new = $new;
}

}?>
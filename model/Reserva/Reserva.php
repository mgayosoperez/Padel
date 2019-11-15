<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Reserva{

    private $idReserva;
    private $fecha;
    private $idPista;

    function __construct($idReserva = NULL, $fecha = NULL, $idPista = NULL){

        $this->idReserva = $idReserva;
        $this->fecha = $fecha;
        $this->idPista = $idPista;
    }
    // geters
public function getIdReserva()
{
    return $this->idReserva;
}

public function getFecha()
{
    return $this->fecha;
}

public function getIdPista()
{
    return $this->idPista;
}

// seters
public function setIdReserva($idReserva)
{
    $this->idReserva = $idReserva;
}

public function setFecha($fecha)
{
    $this->fecha = $fecha;
}

public function setPista($idPista)
{
    $this->idPista = $idPista;
}
}

?>
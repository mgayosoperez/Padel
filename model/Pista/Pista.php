<?php

require_once(__DIR__."/../../core/ValidationException.php");

class Pista{

    private $idPista;
    private $estado;
    private $superficie;

    function __construct($idPista = NULL, $estado = NULL, $superficie = NULL){

        $this->idPista = $idPista;
        $this->estado = $estado;
        $this->superficie = $superficie;
    }

    public function getIdPista()
    {
        return $this->idPista;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getSuperficie()
    {
        return $this->superficie;
    }

    // seters
    public function setIdPista($idPista)
    {
        $this->idPista = $idPista;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;
    }
}
// geters

?>
<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Reserva/Reserva.php");
require_once(__DIR__."/../model/Reserva/ReservaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ReservaController extends BaseController {


	private $ReservaMapper;

	public function __construct() {
		parent::__construct();

		$this->ReservaMapper = new ReservaMapper();

	}

	public function index(){
		$datos= $this->ReservaMapper->getReserva($_SESSION["currentuser"]);
		$reserva = $this->ReservaMapper->numReserva($_SESSION["currentuser"]);
					
	}

	public function addReserva(){
		if(isset($_POST["fecha"])){
			if($this->ReservaMapper->numReserva($_SESSION["currentuser"])<5 && $this->ReservaMapper->pistasOcupadas($_POST["fecha"])<5){
				//crear metodo en PistaMapper para ver las pistas libres
				$reserva = new Reserva();

				$reserva->setFecha($_POST["fecha"]);
				$reserva->setPista("1");

				$this->ReservaMapper->add($reserva);
				sleep (1);
				$this->view->redirect("deportista", "index");
			}else{
				echo("No hay pistas");
			}
			

		}
	}




}

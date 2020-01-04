<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Reserva/Reserva.php");
require_once(__DIR__."/../model/Reserva/ReservaMapper.php");
require_once(__DIR__."/../model/Pista/Pista.php");
require_once(__DIR__."/../model/Pista/PistaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ReservaController extends BaseController {


	private $ReservaMapper;

	public function __construct() {
		parent::__construct();

		$this->ReservaMapper = new ReservaMapper();
		$this->PistaMapper = new PistaMapper();

	}

	public function index(){
		$datos= $this->ReservaMapper->getReserva($_SESSION["currentuser"]);
		$reserva = $this->ReservaMapper->numReserva($_SESSION["currentuser"]);
					
	}

	public function addReserva(){

		if(isset($_POST["fecha"])){
			$pistas = $this->PistaMapper->showPistas();
			$numeroPistas=strval(sizeof($pistas));
			if($this->ReservaMapper->numReserva($_SESSION["currentuser"])<5 && $this->ReservaMapper->pistasOcupadas($_POST["fecha"])<$numeroPistas){
				//crear metodo en PistaMapper para ver las pistas libres
				$reserva = new Reserva();

				$reserva->setFecha($_POST["fecha"]);
				$num=0;
				while($this->ReservaMapper->pistasOcupadasMomento($_POST["fecha"],$pistas[$num]->getIdPista())){
					if($num==$numeroPistas){
						$num=1;
					}else{
						$num=$num+1;
					}		
				}
				$reserva->setPista($pistas[$num]->getIdPista());
				$this->ReservaMapper->add($reserva);
				$this->view->redirect("deportista", "showReservas");
			}else{
				echo("No hay pistas");
			}
			

		}
	}

	public function deleteReserva(){
		$this->ReservaMapper->delete($_GET["idReserva"]);
		$this->view->redirect("deportista", "showReservas");
	}




}

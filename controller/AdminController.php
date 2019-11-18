<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionadoMapper.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../controller/BaseController.php");


class AdminController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();
		$this->CampeonatoMapper = new CampeonatoMapper();
		$this->PartidoPromocionadoMapper = new PartidoPromocionadoMapper();
	}

	public function index(){

		$this->view->render("admin", "index");			
	}
	public function partidoPromocionado(){

		$this->view->render("admin", "promocionado");
	}	

	public function addPartidoPromocionado(){
		$partidoPromocionado = new PartidoPromocionado();
		$partidoPromocionado->setFecha($_POST["fecha"]);
		$partidoPromocionado->setNumDeportista("0");
		$this->PartidoPromocionadoMapper->add($partidoPromocionado);
		$this->view->render("admin", "index");
	}

	public function campeonatos(){

		$campeonato = $this->CampeonatoMapper->campeonatoActivo();

		$this->view->setVariable("campeonato", $campeonato, true);

		$this->view->render("campeonato", "showAllAdmin");
	}

	public function entrenadores(){

	}

	public function logout(){

		session_destroy();
		$this->view->redirect("init", "index");
	}

	

}

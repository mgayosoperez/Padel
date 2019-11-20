<?php

require_once(__DIR__."/../core/ViewManager.php");


require_once(__DIR__."/../model/Campeonato/Campeonato.php");
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
		$this->PartidoPromocionadoMapper->add($partidoPromocionado);
		$this->view->render("admin", "index");
	}
	public function showPartidos(){
		$datos = $this->PartidoPromocionadoMapper->verDisponiblesAdmin();
		$this->view->setVariable("datos",$datos,true);	
		$this->view->render("admin", "showPartidos");
	}

	public function borrarPartido(){
		$this->PartidoPromocionadoMapper->delete($_GET["idPartido"]);
		$this->view->render("admin", "index");
	}

	public function campeonatos(){
		$campeonato = $this->CampeonatoMapper->campeonatoActivo();
		$this->view->setVariable("campeonato", $campeonato, true);
		$this->view->render("campeonato", "showAllAdmin");
	}

	public function crearCampeonato(){
		$this->view->render("campeonato","crearCampeonato");
	}

	public function addCampeonato(){
		$campeonato = new Campeonato();
		$campeonato->setNombre($_POST["nombre"]);
		$campeonato->setFechaInicio($_POST["fechaInicio"]);
		$campeonato->setFechaFin($_POST["fechaFin"]);
		$this->CampeonatoMapper->add($campeonato);
		$this->view->redirect("admin", "campeonatos"); 
	}

	public function deleteCampeonato(){
		$this->CampeonatoMapper->delete($_GET["idCampeonato"]);
		$this->view->redirect("admin", "campeonatos"); 
	}

	public function logout(){

		session_destroy();
		$this->view->redirect("init", "index");
	}

	

}

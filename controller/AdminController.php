<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class AdminController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();
		$this->CampeonatoMapper = new CampeonatoMapper();
	}

	public function index(){

		$this->view->render("admin", "index");			
	}
	public function partidoPromocionado(){

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

<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Pista/Pista.php");
require_once(__DIR__."/../model/Pista/PistaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class PistaController extends BaseController {


	private $PistaMapper;

	public function __construct() {
		parent::__construct();

		$this->PistaMapper = new PistaMapper();

	}

	public function index(){
						
	}

	public function addPista(){
		$pista = new Pista();
		if (isset($_POST["estado"])){

            $pista->setEstado($_POST["estado"]);
            $pista->setSuperficie($_POST["superficie"]);
			
            $this->PistaMapper->add($pista);


            $this->view->redirect("admin", "verPistas");
				
		}

		$this->view->setVariable("pista", $pista);

		$this->view->render("admin", "addPista");
	}

	public function borrarPista(){
		$this->PistaMapper->delete($_GET["idPista"]);
		$this->view->redirect("admin", "verPistas");
	}




}

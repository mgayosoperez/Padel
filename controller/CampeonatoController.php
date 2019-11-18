<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");
require_once(__DIR__."/../model/Campeonato/Campeonato.php");
require_once(__DIR__."/../model/Pareja/ParejaMapper.php");
require_once(__DIR__."/../model/Pareja/Pareja.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class CampeonatoController extends BaseController {


	private $CampeonatoMapper;

	public function __construct() {
		parent::__construct();
		$this->DeportistaMapper = new DeportistaMapper();
		$this->ParejaMapper = new ParejaMapper();

	}

	public function inscribirse(){

		$pareja = new Pareja();
		if (isset($_GET["idCampeonato"])){
			$campeonatoid = $_GET["idCampeonato"];
			$this->view->setVariable("campeonatoid", $campeonatoid, true);
		}
		

		if (isset($_POST["pareja"])){ 
			$pareja->setCapitan($_SESSION["currentuser"]);	
			$pareja->setPareja($_POST["pareja"]);
			$pareja->setIdCampeonato($this->view->getVariable("campeonatoid"));
			$pareja->setNivel($_POST["nivel"]);
			

			try{

				if (!$this->ParejaMapper->parejaExists($_POST["pareja"], $pareja->getIdCampeonato())) {

					if ($this->DeportistaMapper->loginExists($_POST["pareja"])){
						$capitanS = $this->DeportistaMapper->getSexo($_SESSION["currentuser"]);
						$parejaS = $this->DeportistaMapper->getSexo($_POST["pareja"]);

						if($capitanS!=$parejaS){
							$pareja->setCategoria("MIXTA");
						}else if($capitanS == "HOMBRE"){
							$pareja->setCategoria("MASCULINA");
						}else{
							$pareja->setCategoria("FEMENINA");
						}

						$this->ParejaMapper->add($pareja);
						
						$this->view->redirect("deportista", "index");
					} else {
						$errors = array();
						$errors["login"] = "cosas malas";
						$this->view->setVariable("errors", $errors);
					}

				}else {
						$errors = array();
						$errors["cam"] = "id problematico ";
						$this->view->setVariable("errors", $errors);
					}
			}catch(ValidationException $ex) {
				
				$errors = $ex->getErrors();

				$this->view->setVariable("errors", $errors);
			}
		}



		$this->view->render("campeonato", "registro");
	}




}

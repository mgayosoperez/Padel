<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");
require_once(__DIR__."/../model/Campeonato/Campeonato.php");
require_once(__DIR__."/../model/Pareja/ParejaMapper.php");
require_once(__DIR__."/../model/Pareja/Pareja.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");
require_once(__DIR__."/../model/LigaRegular/LigaRegularMapper.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/Notificacion/NotificacionMapper.php");
require_once(__DIR__."/../model/Notificacion/Notificacion.php");


class CampeonatoController extends BaseController {


	private $CampeonatoMapper;

	public function __construct() {
		parent::__construct();
		$this->NotificacionMapper = new NotificacionMapper();
		$this->LigaRegularMapper = new LigaRegularMapper();
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
						$notificacion = new Notificacion();
						$notificacion->setEmisor("admin");
						$notificacion->setDestinatario($_SESSION["currentuser"]);
						$notificacion->setMensaje("Te has desinscrito a un campeonato");
						$this->NotificacionMapper->crearUniCast($notificacion);
						
						$this->view->redirect("deportista", "index");
					} else {
						$errors = array();
						$errors["login"] = "El login es incorrecto";
						$this->view->setVariable("errors", $errors);
					}

				}else {
						$auser=$_SESSION["currentuser"];
						$errors = array();
						$errors["cam"] = "$auser ya esta inscrito es este campeonato";
						$this->view->setVariable("errors", $errors);
					}
			}catch(ValidationException $ex) {
				
				$errors = $ex->getErrors();

				$this->view->setVariable("errors", $errors);
			}
		}



		$this->view->render("campeonato", "registro");
	}

	public function verLiga(){
		$idC = $_GET["idCampeonato"];
		$ligas = $this->LigaRegularMapper->getLigaDeUnCampeonato($idC);
		$ligasConAlgo = array();
		foreach ($ligas as $key => $value) {
				array_push($ligasConAlgo, $value["idLiga"]);
		}
		$this->view->setVariable("ligas", $ligasConAlgo, true);
		$this->view->render("campeonato", "showLigasRegularesDeportista");
	}

	public function verPlayoffs(){
		$idC=$_GET["idCampeonato"];

		$this->view->setVariable("idC",$idC,true);
		
		$this->view->render("deportistas", "showPlayOffs");
	}


}

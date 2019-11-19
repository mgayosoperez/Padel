<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Deportista/Deportista.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");

require_once(__DIR__."/../model/Usuario/UsuarioMapper.php");
require_once(__DIR__."/../model/Usuario/Usuario.php");

require_once(__DIR__."/../model/Reserva/ReservaMapper.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class DeportistaController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();
		$this->UsuarioMapper = new UsuarioMapper();
		$this->DeportistaMapper = new DeportistaMapper();
		$this->ReservaMapper = new ReservaMapper();
		$this->CampeonatoMapper = new CampeonatoMapper();

	}

	public function index(){

		$this->view->render("deportistas", "index");			
	}

	
	public function login() {
		if (isset($_POST["login"])){
			$rol = $this->UsuarioMapper->checkRol($_POST["login"]);
			switch ($rol) {
				case 'DEPORTISTA':
					if ($this->DeportistaMapper->isValidDeportista($_POST["login"], $_POST["passwd"])) {
						$_SESSION["currentuser"]=$_POST["login"];	
						$this->view->redirect("deportista", "index");

					}else{
						$errors = array();
						$errors["general"] = "Deportista is not valid";
						$this->view->setVariable("errors", $errors);
					}
					break;
				case 'ADMIN':
					$_SESSION["currentuser"]=$_POST["login"];
					$this->view->redirect("admin", "index");
					break;
				case 'ENTRENADOR':
					$_SESSION["currentuser"]=$_POST["login"];
					$this->view->redirect("entrenador", "index");
					break;
				
				default:
					$errors = array();
					$errors["general"] = "No hay ningun usuario valido";
					$this->view->setVariable("errors", $errors);
					break;
			}
		}

		$this->view->render("deportistas", "login");
	}

	
	public function register() {

		$deportista = new Deportista();
		$usuario = new Usuario();
		if (isset($_POST["login"])){ 
			$usuario->setLogin($_POST["login"]);	
			$usuario->setRol("DEPORTISTA");

			$deportista->setLogin($_POST["login"]);
			$deportista->setPassword($_POST["passwd"]);
			$deportista->setNombre($_POST["nombre"]);
			$deportista->setApellidos($_POST["apellidos"]);
			$deportista->setSexo($_POST["sexo"]);
			$deportista->setDni($_POST["dni"]);

			try{
				$deportista->checkIsValidForRegister(); 

				if (!($this->UsuarioMapper->loginExists($_POST["login"]))){
					$this->UsuarioMapper->add($usuario);
					$this->DeportistaMapper->save($deportista);

					
					$this->view->setFlash("Login ".$deportista->getNombre()." successfully added. Please login now");

					
					$this->view->redirect("deportista", "login");
				} else {
					$errors = array();
					$errors["login"] = "login already exists";
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				
				$errors = $ex->getErrors();

				$this->view->setVariable("errors", $errors);
			}
		}


		$this->view->setVariable("deportista", $deportista);

		$this->view->render("deportistas", "register");

	}

	public function showReservas(){
		$datos=$this->ReservaMapper->getHasReserva($_SESSION["currentuser"]);
		$toret=array();
		foreach ($datos as $key) {
			array_push($toret,$this->ReservaMapper->getReserva($key));
		}
		$this->view->setVariable("cosa",$toret,true);
		$this->view->render("deportistas", "showReserva");
	}

	public function reserva(){
		$this->view->render("deportistas", "reserva");
	}

	public function logout() {
		session_destroy();
		$this->view->redirect("init", "index");

	}

	public function campeonatos(){

		$campeonato = $this->CampeonatoMapper->campeonatoActivo();

		$this->view->setVariable("campeonato", $campeonato, true);

		$this->view->render("campeonato", "showAll");
	}

		public function inscribirsePromocionado(){

		if (isset($_GET["idPromocionado"])){
			
			$numDeportistas = $this->PartidoPromocionadoMapper->numDeportistas($_GET["idPromocionado"]);

			if($numDeportistas >= 4){
				return "No hay plazas";
			}else{

				$this->PartidoPromocionadoMapper->inscribirse($_SESSION["currentuser"],$_GET["idPromocionado"]);
			}
			$this->view->render("partidospromocionados", "showAll");
		}

	}

}

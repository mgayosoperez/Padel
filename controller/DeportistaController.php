<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Deportista/Deportista.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");

require_once(__DIR__."/../model/Usuario/UsuarioMapper.php");
require_once(__DIR__."/../model/Usuario/Usuario.php");

require_once(__DIR__."/../model/Reserva/ReservaMapper.php");

require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionadoMapper.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


require_once(__DIR__."/../model/Entrenador/EntrenadorMapper.php");
require_once(__DIR__."/../model/Admin/AdminMapper.php");

require_once(__DIR__."/../model/Pista/PistaMapper.php");
require_once(__DIR__."/../model/Pista/Pista.php");

require_once(__DIR__."/../model/Pago/Pago.php");
require_once(__DIR__."/../model/Pago/PagoMapper.php");

require_once(__DIR__."/../model/Notificacion/NotificacionMapper.php");
require_once(__DIR__."/../model/Notificacion/Notificacion.php");


class DeportistaController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();
		$this->PistaMapper = new PistaMapper();
		$this->UsuarioMapper = new UsuarioMapper();
		$this->DeportistaMapper = new DeportistaMapper();
		$this->ReservaMapper = new ReservaMapper();
		$this->CampeonatoMapper = new CampeonatoMapper();
		$this->PartidoPromocionadoMapper = new PartidoPromocionadoMapper();
		$this->AdminMapper = new AdminMapper();
		$this->EntrenadorMapper = new EntrenadorMapper();
		$this->PagoMapper = new PagoMapper();
		$this->NotificacionMapper = new NotificacionMapper();

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
						$errors["general"] = "El login o contraseña es incorrecta.";
						$this->view->setVariable("errors", $errors);
					}
					break;
				case 'ADMIN':
					if($this->AdminMapper->isValidAdmin($_POST["login"], $_POST["passwd"])) {
						$_SESSION["currentuser"]=$_POST["login"];
						$this->view->redirect("admin", "index");
					}else{
						$errors = array();
						$errors["general"] = "El login o contraseña es incorrecta.";
						$this->view->setVariable("errors", $errors);
					}
					break;
				case 'ENTRENADOR':
					if($this->EntrenadorMapper->isValidEntrenador($_POST["login"], $_POST["passwd"])) {
						$_SESSION["currentuser"]=$_POST["login"];
						$this->view->redirect("clase", "index");
					}else{
						$errors = array();
						$errors["general"] = "El login o contraseña es incorrecta.";
						$this->view->setVariable("errors", $errors);
					}
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
			$numeroPistas = $this->PistaMapper->numeroPistas();
			$numDeportistas = $this->PartidoPromocionadoMapper->numDeportistas($_GET["idPromocionado"]);
			$fecha = $this->PartidoPromocionadoMapper->findByIdPromocionado($_GET["idPromocionado"])["fecha"];
			if($numDeportistas >= 4){
				return "No hay plazas";
			}else{
				if($this->ReservaMapper->pistasOcupadas($fecha)<$numeroPistas){
					$this->PartidoPromocionadoMapper->inscribirse($_SESSION["currentuser"],$_GET["idPromocionado"]);
					$notificacion = new Notificacion();
					$notificacion->setEmisor("admin");
					$notificacion->setDestinatario($_SESSION["currentuser"]);
					$notificacion->setMensaje("Te has inscrito a un partido promocionado");
					$this->NotificacionMapper->crearUniCast($notificacion);
					if($this->PartidoPromocionadoMapper->numDeportistas($_GET["idPromocionado"])==4){
						$this->PartidoPromocionadoMapper->crearReserva($this->PartidoPromocionadoMapper->findByIdPromocionado($_GET["idPromocionado"]));
					}
					$this->view->redirect("deportista", "showPromocionados");
				}else{
					$this->PartidoPromocionadoMapper->delete($_GET["idPromocionado"]);
					$this->view->redirect("deportista", "showPromocionados");
				}
			}

		}

	}

	public function desinscribirsePromocionado(){
		if (isset($_GET["idPromocionado"])){
			if(!is_null($this->PartidoPromocionadoMapper->findByIdPromocionado($_GET["idPromocionado"])["idReserva"])){
				$this->ReservaMapper->delete($this->PartidoPromocionadoMapper->findByIdPromocionado($_GET["idPromocionado"])["idReserva"]);
			}

					$notificacion = new Notificacion();
					$notificacion->setEmisor("admin");
					$notificacion->setDestinatario($_SESSION["currentuser"]);
					$notificacion->setMensaje("Te has desinscrito a un partido promocionado");
					$this->NotificacionMapper->crearUniCast($notificacion);

			$this->PartidoPromocionadoMapper->desinscribirse($_SESSION["currentuser"],$_GET["idPromocionado"]);
				//eliminar la reserva hasta que se vuelva a inscribir 4
			}
			$this->view->redirect("deportista", "showPromocionados");
	}



	public function showPromocionados(){

		$datos = $this->PartidoPromocionadoMapper->verDisponibles($_SESSION["currentuser"]);
		$inscritos = $this->PartidoPromocionadoMapper->verInscritos($_SESSION["currentuser"]);

		$partidoPromocionado = new PartidoPromocionado();
		$partido2 = new PartidoPromocionado();
		foreach ($datos as $key => $value ) {
			$partidoPromocionado=$value;
			foreach ($inscritos as $keyt => $values) {
				$partido2=$values;
				if($partidoPromocionado->getIdPromocionado()==$partido2->getIdPromocionado()){
					unset($datos[$key]);
				}
			}
		}
		$this->view->setVariable("pInscritos",$inscritos,true);

		$this->view->setVariable("pPromocionado",$datos,true);
		$this->view->render("deportistas", "partidoPromocionado");
	}

	public function pagos(){
		$misPagos = $this->PagoMapper->facturasDeportista($_SESSION["currentuser"]);
		$this->view->setVariable("misPagos", $misPagos);
		$this->view->render("deportistas", "pagos");
	}

	public function pagar(){
		if(isset($_POST["idFactura"])){
			$this->PagoMapper->pagar($_POST["idFactura"]);

		}else{
			if(isset($_GET["idFactura"])){ //RENDEr FORMULARIO
				$this->view->setVariable("idFactura", $_GET["idFactura"]);
				$this->view->setVariable("importe", $_GET["importe"]);
				$this->view->render("deportistas", "pagar");
			}
		}
		$this->view->redirect("deportista", "pagos");
		/*if(isset($_GET["idFactura"])){
			$this->PagoMapper->pagar($_GET["idFactura"]);
		}
		$this->view->redirect("deportista", "pagos");*/



	}



}

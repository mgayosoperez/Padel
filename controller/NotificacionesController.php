<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/Notificacion/NotificacionMapper.php");
require_once(__DIR__."/../model/Notificacion/Notificacion.php");

class NotificacionesController extends BaseController {


	private $ReservaMapper;

	public function __construct() {
		parent::__construct();
		$this->NotificacionMapper = new NotificacionMapper();

	}

	public function addNotificacionAdmin(){
		$Notificacion = new Notificacion();
		$Notificacion->setEmisor($_POST["user"]);
		$Notificacion->setDestinatario($_POST["destinatario"]);
		$Notificacion->setMensaje($_POST["texto"]);
		$this->NotificacionMapper->crearUniCast($Notificacion);
		$this->view->render("admin", "showNotificacionesEnviadas");
	}


	public function addNotificacionDeportista(){
		$Notificacion = new Notificacion();
		$Notificacion->setEmisor($_POST["user"]);
		$Notificacion->setDestinatario($_POST["destinatario"]);
		$Notificacion->setMensaje($_POST["texto"]);
		$this->NotificacionMapper->crearUniCast($Notificacion);
		$this->view->render("deportistas", "showNotificacionesEnviadas");
	}

		public function addNotificacionEntrenador(){
		$Notificacion = new Notificacion();
		$Notificacion->setEmisor($_POST["user"]);
		$Notificacion->setDestinatario($_POST["destinatario"]);
		$Notificacion->setMensaje($_POST["texto"]);
		$this->NotificacionMapper->crearUniCast($Notificacion);
		$this->view->render("entrenadores", "showNotificacionesEnviadas");
	}


	public function addNotificacionBroadcast(){
		$Notificacion = new Notificacion();
		$Notificacion->setEmisor($_POST["user"]);
		$Notificacion->setDestinatario($_POST["destinatario"]);
		$Notificacion->setMensaje($_POST["texto"]);
		$this->NotificacionMapper->crearBroadCast($Notificacion,$_POST["tipo"]);
		$this->view->render("admin", "showNotificacionesEnviadas");
	}


	public function verNotificacionesAdmin(){
		$this->view->render("admin", "verNotificaciones");
	}

	public function verNotificacionesDeportista(){
		$this->view->render("deportistas", "verNotificaciones");
	}

	public function verNotificacionesEntrenador(){
		$this->view->render("entrenadores", "verNotificaciones");
	}

	public function verNotificacionesEnviadasAdmin(){
		$this->view->render("admin", "showNotificacionesEnviadas");
	}

	public function verNotificacionesEnviadasDeportista(){
		$this->view->render("deportistas", "showNotificacionesEnviadas");
	}

	public function verNotificacionesEnviadasEntrenador(){
		$this->view->render("entrenadores", "showNotificacionesEnviadas");
	}

	public function addAdmin(){
		$this->view->render("admin", "crearNotificacion");
	}

	public function addDeportista(){
		$this->view->render("deportistas", "crearNotificacion");
	}

	public function addEntrenador(){
		$this->view->render("entrenadores", "crearNotificacion");
	}

	public function deleteA(){
		$this->NotificacionMapper->delete($_GET["idN"]);
		$this->view->render("admin", "verNotificaciones");
	}
	public function deleteD(){
		$this->NotificacionMapper->delete($_GET["idN"]);
		$this->view->render("deportistas", "verNotificaciones");
	}
	public function deleteE(){
		$this->NotificacionMapper->delete($_GET["idN"]);
		$this->view->render("entrenadores", "verNotificaciones");
	}


}

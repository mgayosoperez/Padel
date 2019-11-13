<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Deportista/Deportista.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class DeportistaController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();

		$this->DeportistaMapper = new DeportistaMapper();

	}

	public function index(){
		$this->view->render("deportistas", "index");
	}

	
	public function login() {
		if (isset($_POST["login"])){ 
			if ($this->DeportistaMapper->isValidDeportista($_POST["login"], $_POST["passwd"])) {

				$_SESSION["currentuser"]=$_POST["login"];
				$this->view->setVariable("user", $_POST["login"]);	
				$this->view->redirect("deportista", "index");

			}else{
				$errors = array();
				$errors["general"] = "Deportista is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}

		
		$this->view->render("deportistas", "login");
	}

	
	public function register() {

		$deportista = new Deportista();
		if (isset($_POST["login"])){ 
			
			$deportista->setLogin($_POST["login"]);
			$deportista->setPassword($_POST["passwd"]);
			$deportista->setNombre($_POST["nombre"]);
			$deportista->setApellidos($_POST["apellidos"]);
			$deportista->setSexo($_POST["sexo"]);
			$deportista->setDni($_POST["dni"]);

			try{
				$deportista->checkIsValidForRegister(); 

				if (!($this->DeportistaMapper->loginExists($_POST["login"]))){
					
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

	public function reserva(){
		$this->view->render("deportistas", "reserva");
	}

	public function logout() {
		session_destroy();
		$this->view->redirect("deportistas", "login");

	}

}

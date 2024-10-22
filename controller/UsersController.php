<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Deportista/Deportista.php");
require_once(__DIR__."/../model/Deportista/DeportistaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class DeportistaController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();

		$this->DeportistaMapper = new DeportistaMapper();

	}

	
	public function login() {
		if (isset($_POST["deportista"])){ 
		
			if ($this->deportistaMapper->isValidUser($_POST["login"], $_POST["passwd"])) {

				$_SESSION["currentdeportista"]=$_POST["deportista"];

				
				$this->view->redirect("deportista", "index");    //lo vamos viendo papa

			}else{
				$errors = array();
				$errors["general"] = "Deportista is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}

		
		$this->view->render("deportista", "login");
	}

	
	public function register() {

		$deportista = new Deportista();

		if (isset($_POST["login"])){ 

			
			$deportista->setLogin($_POST["login"]);
			$deportista->setPassword($_POST["passwd"]);
			$deportista->setName($_POST["nombre"]);
			$deportista->setApellidos($_POST["apellidos"]);
			$deportista->setSexo($_POST["sexo"]);

			try{
				$deportista->checkIsValidForRegister(); 

				if (!$this->deportistaMapper->loginExists($_POST["login"])){

					
					$this->deportistaMapper->save($deportista);

					
					$this->view->setFlash("Login ".$deportista->getUsername()." successfully added. Please login now");

					
					$this->view->redirect("deportistas", "login");
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


	public function logout() {
		session_destroy();
		$this->view->redirect("deportistas", "login");

	}

}

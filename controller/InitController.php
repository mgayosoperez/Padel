<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class InitController extends BaseController {



	public function __construct() {
		parent::__construct();

	}

	
	public function index() {
		$this->view->render("init", "indexo");
	}
}
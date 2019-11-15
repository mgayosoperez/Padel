<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");


/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 *
 * @author lipido <lipido@gmail.com>
 */
class BaseController {

	/**
	 * The view manager instance
	 * @var ViewManager
	 */
	protected $view;

	/**
	 * The current user instance
	 * @var User
	 */
	protected $currentUser;

	public function __construct() {

		$this->view = ViewManager::getInstance();

		// get the current user and put it to the view
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

}

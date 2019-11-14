<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Entrenador/Entrenador.php");
require_once(__DIR__."/../model/Entrenador/EntrenadorMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 *
 */
class EntrenadorController extends BaseController
{

  private $entrenadorMapper;

  public function __construct(){
      parent::__construct();

    $this->entrenadorMapper = new EntrenadorMapper();
  }

  public function index(){
    $entrenadores = $this->entrenadorMapper->findAll();
    $this->view->setVariable("entrenadores", $entrenadores);
    $this->view->render("entrenadores", "showall");
  }



  public function add(){
    $entrenador = new Entrenador();

    if (isset($_POST["login"])){ // reaching via HTTP Post...

			// populate the User object with data form the form
			$entrenador->setLogin($_POST["login"]);
			$entrenador->setPasswd($_POST["passwd"]);
      $entrenador->setDni($_POST["dni"]);
      $entrenador->setNss($_POST["nss"]);
			$entrenador->setNombre($_POST["nombre"]);
			$entrenador->setApellidos($_POST["apellidos"]);
			$entrenador->setSexo($_POST["sexo"]);

      try{
        $entrenador->checkIsValidForRegister();

        if (!$this->entrenadorMapper->entrenadorExiste($_POST["login"])) {
          // Guardamos el ENTRENADOR
          $this->entrenadorMapper->add($entrenador);

          $this->view->setFlash("Entrenador ".$entrenador->getLogin()." añadido.");
          //Redirijimos la vista a index.php?Controller=entrenador&action=index
          $this->view->redirect("entrenador", "index");
        }else {
					$errors = array();
					$errors["username"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}
      }catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}

    }
      $this->view->setVariable("entrenador", $entrenador);
      //render the view (/view/entrenadores/add.php)
  		$this->view->render("entrenadores", "add");
    }



  public function delete(){
    $entrenador = new Entrenador();
    if(isset($_GET["username"])){
      /*$entrenador->setLogin($_POST["username"]);
			$entrenador->setPasswd($_POST["passwd"]);
      $entrenador->setDni($_POST["dni"]);
      $entrenador->setNss($_POST["nss"]);
			$entrenador->setNombre($_POST["nombre"]);
			$entrenador->setApellidos($_POST["apellidos"]);
			$entrenador->setSexo($_POST["sexo"]);*/

      if (!$this->entrenadorMapper->entrenadorExiste($_GET["username"])) {
        $errors = array();
        $errors["username"] = "Entrenador no existe";
        $this->view->setVariable("errors", $errors);
      }else{
        $entrenador = $this->entrenadorMapper->findByUsername($_GET["username"]);


        $this->entrenadorMapper->delete($entrenador);

        $this->view->setFlash("Entrenador ".$entrenador->getLogin()." borrado.");
        //Redirijimos la vista a index.php?Controller=entrenador&action=index
        $this->view->redirect("entrenador", "index");
      }
    }

    $entrenador = $this->entrenadorMapper->findByUsername($_GET["login"]);
    $this->view->setVariable("entrenador", $entrenador);
    //render the view (/view/entrenadores/add.php)
    $this->view->render("entrenadores", "delete");

  }


  public function update(){
    $entrenador = new Entrenador();

    if (isset($_POST["username"])){ // reaching via HTTP Post...

			// populate the User object with data form the form
			$entrenador->setLogin($_POST["username"]);
			$entrenador->setPasswd($_POST["passwd"]);
      $entrenador->setDni($_POST["dni"]);
      $entrenador->setNss($_POST["nss"]);
			$entrenador->setNombre($_POST["nombre"]);
			$entrenador->setApellidos($_POST["apellidos"]);
			$entrenador->setSexo($_POST["sexo"]);

      try{
        $entrenador->checkIsValidForRegister();

        if ($this->entrenadorMapper->entrenadorExiste($_POST["username"])) {
          // Guardamos el ENTRENADOR
          $this->entrenadorMapper->update($entrenador);

          $this->view->setFlash("Username ".$entrenador->getLogin()." successfully updated.");
          //Redirijimos la vista a index.php?Controller=entrenador&action=index
          $this->view->redirect("entrenador", "index");
        }else {
					$errors = array();
					$errors["username"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}
      }catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}

    }
    $entrenador = $this->entrenadorMapper->findByUsername($_GET["login"]);
    // Put the Entrenador object visible to the view

    $this->view->setVariable("entrenador", $entrenador);
      // render the view (/view/entrenadores/update.php)
    $this->view->render("entrenadores", "edit");

}

  public function showcurrent(){
    if(isset($_POST["username"])){
      $array = $this->entrenadorMapper->findByUsername($_POST["username"]);
      $entrenador = new Entrenador();
      $entrenador->setLogin($array["login"]);
      $entrenador->setPasswd($array["password"]);
      $entrenador->setDni($array["DNI"]);
      $entrenador->setNss($array["NSS"]);
      $entrenador->setNombre($array["nombre"]);
      $entrenador->setApellidos($array["apellidos"]);
      $entrenador->setSexo($array["sexo"]);

      $this->view->setVariable("entrenador", $entrenador);
    }


    $this->view->render("entrenadores", "showcurrent");
  }


}


 ?>

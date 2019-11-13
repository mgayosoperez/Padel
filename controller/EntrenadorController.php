<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Entrenador.php");
require_once(__DIR__."/../model/EntrenadorMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 *
 */
class EntrenadorController extends BaseController
{

  private $entrenadorMapper;

  function __construct()
  {
    $this->entrenadorMapper = new EntrenadorMapper();
  }

  public function index(){
    $entrenadores = $this->entrenadorMapper->findAll();
    $this->view->setVariable("entrenadores", $entrenadores);
    $this->view->render("entrenadores", "showall");
  }



  public function add(){
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
      $entrenador->setClase($_POST["clase"]);

      try{
        $entrenador->checkIsValidForRegister();

        if (!$this->entrenadorMapper->entrenadorExiste($_POST["username"])) {
          // Guardamos el ENTRENADOR
          $this->entrenadorMapper->add($entrenador);

          $this->view->setFlash("Username ".$entrenador->getLogin()." successfully added. Please login now");
          //Redirijimos la vista a index.php?Controller=entrenador&action=showall
          $this->view->redirect("entrenador", "showall");
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

    }else {
      //$this->view->setVariable("entrenador", $entrenador);
      // render the view (/view/entrenadores/add.php)
  		$this->view->render("entrenadores", "add");
    }
  }


  public function delete(){
    $entrenador = new Entrenador();
    if(isset($_POST["username"])){
      $entrenador->setLogin($_POST["username"]);
			$entrenador->setPasswd($_POST["passwd"]);
      $entrenador->setDni($_POST["dni"]);
      $entrenador->setNss($_POST["nss"]);
			$entrenador->setNombre($_POST["nombre"]);
			$entrenador->setApellidos($_POST["apellidos"]);
			$entrenador->setSexo($_POST["sexo"]);
      $entrenador->setClase($_POST["clase"]);

      if (!$this->entrenadorMapper->entrenadorExiste($_POST["username"])) {
        $errors = array();
        $errors["username"] = "Entrenador no existe";
        $this->view->setVariable("errors", $errors);
      }else{
        $this->entrenadorMapper->delete($entrenador);
      }

    }
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
      $entrenador->setClase($_POST["clase"]);

      try{
        $entrenador->checkIsValidForRegister();

        if ($this->entrenadorMapper->entrenadorExiste($_POST["username"])) {
          // Guardamos el ENTRENADOR
          $this->entrenadorMapper->update($entrenador);

          $this->view->setFlash("Username ".$entrenador->getLogin()." successfully updated. Please login now");
          //Redirijimos la vista a index.php?Controller=entrenador&action=showall
          $this->view->redirect("entrenador", "showall");
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

    }else if(isset($_POST["login"])){
        $array = $this->entrenadorMapper->findByUsername($_POST["login"]);
        /*$entrenador->setLogin($array["Login"]);
  			$entrenador->setPasswd($array["Password"]);
        $entrenador->setDni($array["DNI"]);
        $entrenador->setNss($array["NSS"]);
  			$entrenador->setNombre($array["Nombre"]);
  			$entrenador->setApellidos($array["Apellidos"]);
  			$entrenador->setSexo($array["Sexo"]);
        $entrenador->setClase($array["Clase"]);*/
      }
      // Put the User object visible to the view
  		$this->view->setVariable("entrenador", $array); //O $entrenador ???

  		// render the view (/view/entrenadores/update.php)
  		$this->view->render("entrenadores", "update");
}

  public function showcurrent(){
    $entrenador = $this->entrenadorMapper->findByUsername($_POST["username"]);
    $this->view->setVariable("entrenador", $entrenador);
    $this->view->render("entrenadores", "showcurrent");
  }


}


 ?>

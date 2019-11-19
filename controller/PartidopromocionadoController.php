<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionado.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionadoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 *
 */
class PartidoPromocionadoController extends BaseController
{

  private $partidoMapper;

  public function __construct(){
      parent::__construct();

    $this->partidoMapper = new PartidoPromocionadoMapper();
  }

  public function index(){
    $partidos = $this->partidoMapper->findAll();
    $this->view->setVariable("partidos", $partidos);
    $this->view->render("partidospromocionados", "showall");
  }



  public function add(){
    $partido = new PartidoPromocionado();

    if (isset($_POST["fecha"])){ // reaching via HTTP Post...

			// populate the User object with data form the form
			$partido->setFecha($_POST["fecha"]);
      $partido->setNumDeportista($_POST["numDeportista"]);




        if (!$this->partidoMapper->existePromocionado($_POST["fecha"])) {
          // Guardamos el ENTRENADOR
          $this->partidoMapper->add($partido);

          $this->view->setFlash("Partido Promocionado ".$partido->getIdPromocionado()." añadido.");
          //Redirijimos la vista a index.php?Controller=entrenador&action=index
          $this->view->redirect("partidopromocionado", "index");
        }else {
					$errors = array();
					$errors["username"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}


    }
      $this->view->setVariable("partido", $partido);
      //render the view (/view/entrenadores/add.php)
  		$this->view->render("partidospromocionados", "add");
    }



    public function delete(){
      $partido = new PartidoPromocionado();
      if(isset($_GET["idPromocionado"])){
        $partido->setIdPromocionado($_GET["idPromocionado"]);


        if (!$this->partidoMapper->existePromocionado($_GET["idPromocionado"])) {
          $errors = array();
          $errors["reserva"] = "Reserva ocupada";
          $this->view->setVariable("errors", $errors);
        }else{
          $this->partidoMapper->delete($partido);
          $this->view->redirect("partidopromocionado", "index");
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

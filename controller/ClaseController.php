<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Clase/Clase.php");
require_once(__DIR__."/../model/Clase/ClaseMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 *
 */
class ClaseController extends BaseController
{

  private $claseMapper;

  public function __construct(){
      parent::__construct();

    $this->claseMapper = new ClaseMapper();
  }
  //Visualiza las Clases del Entrenador logueado + opciones de Añadir, Editar, Borrar
  public function index(){
    $clases = $this->claseMapper->findAllById("profe1"); //Pasarle el Login del ENTRENADOR Logueado
    $this->view->setVariable('clases', $clases);
    //    /view/clases/showall.php
    $this->view->render('clases', 'showall');
  }

  //Visualiza Todas las Clases para el usuario que se quiera Inscribir (vista Deportista)
  public function clases(){
    $clases = $this->claseMapper->findAll();
    $this->view->setVariable('clases', $clases);
    //    /view/clases/showall.php
    $this->view->render('clases', 'showall_user');
  }

  //Crea Clase
  public function add(){
    $clase = new Clase();
    if(isset($_POST["maxAlum"])){

      $clase->setMaxAlum($_POST["maxAlum"]);
      $clase->setLogin("profe3"); //Login Entrenador Logueado $_SESSION["currentuser"]??

      $this->claseMapper->crear($clase);
      $this->view->setFlash("Clase ".$clase->getReserva()." successfully added.");
      //Redirijimos la vista a index.php?Controller=clase&action=index
      $this->view->redirect("clase", "index");

    }
    $this->view->setVariable("clase", $clase);
    //render the view (/view/entrenadores/add.php)
    $this->view->render("clases", "add");
  }

  public function update(){
    $clase = new Clase();
    if(isset($_POST["idClase"])){
      $clase->setIdClase($_POST["idClase"]);
      $clase->setReserva($_POST["reserva"]);
      $clase->setLogin($_POST["username"]);
      if($this->claseMapper->existeClaseId($_POST["idClase"])){
        $this->claseMapper->update($clase);
        $this->view->setFlash("Clase ".$clase->getReserva()." successfully updated.");
        //Redirijimos la vista a index.php?Controller=entrenador&action=index
        $this->view->redirect("clase", "showall");
      }
    }
  }

  public function delete(){
    $clase = new Clase();
    if(isset($_GET["idClase"])){
      $clase->setIdClase($_GET["idClase"]);


      if (!$this->claseMapper->existeClaseId($_GET["idClase"])) {
        $errors = array();
        $errors["reserva"] = "Reserva ocupada";
        $this->view->setVariable("errors", $errors);
      }else{
        $this->claseMapper->delete($clase);
        $this->view->redirect("clase", "index");
      }

    }
  }

  public function inscribirse(){
    if (isset($_GET["idClase"])) {

      if (!$this->claseMapper->existeClaseId($_GET["idClase"])) {
        $errors = array();
        $errors["reserva"] = "Clase no existe";
        $this->view->setVariable("errors", $errors);
    }else{
      $this->claseMapper->inscribir(($_GET["idClase"]), $_SESSION["currentuser"]);
      $this->view->redirect("clase", "clases");
    }
  }
}


}

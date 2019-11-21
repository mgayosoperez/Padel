<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Clase/Clase.php");
require_once(__DIR__."/../model/Clase/ClaseMapper.php");

require_once(__DIR__."/../model/Reserva/Reserva.php");
require_once(__DIR__."/../model/Reserva/ReservaMapper.php");

require_once(__DIR__."/../model/Entrenador/Entrenador.php");
require_once(__DIR__."/../model/Entrenador/EntrenadorMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ClaseController extends BaseController
{

  private $claseMapper;
  private $reservaMapper;
  private $entrenadorMapper;

  public function __construct(){
      parent::__construct();

    $this->claseMapper = new ClaseMapper();
    $this->reservaMapper = new ReservaMapper();
    $this->entrenadorMapper = new EntrenadorMapper();
  }
  //Visualiza las Clases del Entrenador logueado + opciones de Añadir, Editar, Borrar
  public function index(){
    $clases = $this->claseMapper->findAllById($_SESSION["currentuser"]); //Pasarle el Login del ENTRENADOR Logueado
    foreach ($clases as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
      $descripcion = $this->claseMapper->getClaseGrupal($clase->getIdClase());
      $clase->setDescripcion($descripcion["descripcion"]);
    }

    $this->view->setVariable('clases', $clases);
  //  $this->view->setVariable('fechas', $fechas);
    //    /view/clases/showall.php
    $this->view->render('entrenadores', 'index');
  }

  public function clasesGrupales(){
    $misclasesGrupales = $this->claseMapper->misClasesGrupales($_SESSION["currentuser"]);//Deportista Logueado
    $this->view->setVariable('misclasesGrupales', $misclasesGrupales);
    $clasesGrupales = $this->claseMapper->findAllGrupales();
    foreach ($clasesGrupales as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('clasesGrupales', $clasesGrupales);

    $this->view->render('clases', 'clasesGrupales');
  }

  //Visualiza Todas las Clases para el usuario que se quiera Inscribir (vista Deportista)
  public function clasesParticulares(){
    $entrenadores = $this->entrenadorMapper->findAll();
    $this->view->setVariable("entrenadores", $entrenadores);
    $misclasesParticulares = $this->claseMapper->misClasesParticulares($_SESSION["currentuser"]);//Deportista Logueado
    foreach ($misclasesParticulares as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('misClasesParticulares', $misclasesParticulares);
    //    /view/clases/showall.php
    $this->view->render('clases', 'clasesParticulares');
  }


  //Crea ClaseGrupal
  public function add(){
    $clase = new Clase();
    if(isset($_POST["fecha"])){
      if($this->reservaMapper->pistasOcupadas($_POST["fecha"])<5){     //P

        //Crear Reserva
        $reserva = new Reserva();
        $reserva->setFecha($_POST["fecha"]);
        $reserva->setPista("1");
        $idReserva = $this->reservaMapper->addClase($reserva);  //Reserva la pista para la clase
        //CREAR cLASE
        $clase->setLogin($_SESSION["currentuser"]);//Login Entrenador Logueado $_SESSION["currentuser"]??
        $clase->setReserva($idReserva);
        if($_POST["maxAlum"] > 1){
          $clase->setRol("GRUPAL");
          $idClase = $this->claseMapper->crear($clase); //crea en la tabla clase
          $this->claseMapper->crearGrupal($idClase, $_POST["maxAlum"], $_POST["descripcion"]); //Crea en la tabla Clase_Grupal
        }
      }
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
        //Redirijimos la vista a index.php?Controller=entrenador&action=index
        $this->view->redirect("clase", "showall");
      }
    }
  }

  public function delete(){
    $clase = new Clase();
    if(isset($_GET["idClase"]) && isset($_GET["reserva"])){
      $clase->setIdClase($_GET["idClase"]);
      $clase->setReserva($_GET["reserva"]);


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
  public function inscribirseParticular(){
    $clase = new Clase();
    if (!isset($_GET["entrenador"])) {
      if(isset($_POST["fecha"]) & isset($_POST["entrenador"])){
        if($this->reservaMapper->pistasOcupadas($_POST["fecha"])<5 || $this->claseMapper->entrenadorHasClase($_POST["fecha"], $_POST["entrenador"])){
          //Crear Reserva
          $reserva = new Reserva();
          $reserva->setFecha($_POST["fecha"]);
          $reserva->setPista("1");
          $idReserva = $this->reservaMapper->addClase($reserva);  //Reserva la pista para la clase
          //CREAR cLASE
          $clase->setLogin($_POST["entrenador"]);//Login Entrenador se le pasa como parametro
          $clase->setReserva($idReserva);
          $clase->setRol("PARTICULAR");

          $idClase = $this->claseMapper->crear($clase);
          $this->claseMapper->crearParticular($idClase, $_SESSION["currentuser"]);
        }
      }
    }else{
        $this->view->setVariable("entrenador", $_GET["entrenador"]);
        $this->view->render("clases", "addParticular");
      }
    $this->view->redirect("clase", "clasesParticulares");
  }

  public function inscribirse(){
    if (isset($_GET["idClase"])) {

      if (!$this->claseMapper->existeClaseId($_GET["idClase"])) {
        $errors = array();
        $errors["clase"] = "Clase no existe";
        $this->view->setVariable("errors", $errors);
      }else{
        $clase = $this->claseMapper->getClase($_GET["idClase"]);
        if($clase["rol"] == "GRUPAL"){
          $claseGrupal = $this->claseMapper->getClaseGrupal($_GET["idClase"]);
          $numAlum = $this->claseMapper->getNumAlum($_GET["idClase"]);
          if ($numAlum < $claseGrupal["maxAlumnos"]) {                            //Comprobamos si hay plazas libres
            $this->claseMapper->inscribirGrupal($_GET["idClase"], $_SESSION["currentuser"]);
          }else {
            $errors["clase"] = "Clase Completa";
            $this->view->setVariable("errors", $errors);

          }
          $this->view->redirect("clase", "clasesGrupales");

        }elseif ($clase["rol"] == "PARTICULAR") {
          if(!$this->claseMapper->existeParticular($_GET["idClase"])){
            $this->claseMapper->inscribirParticular(($_GET["idClase"]), $_SESSION["currentuser"]);
          }else{
            $errors["clase"] = "Clase Completa";
            $this->view->setVariable("errors", $errors);

          }
          $this->view->redirect("clase", "clasesParticulares");
      }
    }
  }
}

public function desinscribirse(){
  if (isset($_GET["idClase"])) {

    if (!$this->claseMapper->existeClaseId($_GET["idClase"])) {
      $errors = array();
      $errors["reserva"] = "Clase no existe";
      $this->view->setVariable("errors", $errors);
    }else{
      $clase = $this->claseMapper->getClase($_GET["idClase"]);
      if($clase["rol"] == "GRUPAL"){
        $this->claseMapper->desinscribirGrupal($_GET["idClase"], $_SESSION["currentuser"]);
        $this->view->redirect("clase", "clasesGrupales");
      }elseif ($clase["rol"] == "PARTICULAR") {
        $this->claseMapper->desinscribirParticular($_GET["idClase"], $_SESSION["currentuser"], $_GET["reserva"]);
        $this->view->redirect("clase", "clasesParticulares");
      }
    }
  }
}


}

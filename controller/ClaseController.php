<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Clase/Clase.php");
//require_once(__DIR__."/../model/Clase/Clase_Grupal.php");
require_once(__DIR__."/../model/Clase/ClaseMapper.php");

require_once(__DIR__."/../model/Reserva/Reserva.php");
require_once(__DIR__."/../model/Reserva/ReservaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 *
 */
class ClaseController extends BaseController
{

  private $claseMapper;
  private $reservaMapper;

  public function __construct(){
      parent::__construct();

    $this->claseMapper = new ClaseMapper();
    $this->reservaMapper = new ReservaMapper();
  }
  //Visualiza las Clases del Entrenador logueado + opciones de Añadir, Editar, Borrar
  public function index(){
    $clases = $this->claseMapper->findAllById($_SESSION["currentuser"]); //Pasarle el Login del ENTRENADOR Logueado
    foreach ($clases as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }

    $this->view->setVariable('clases', $clases);
  //  $this->view->setVariable('fechas', $fechas);
    //    /view/clases/showall.php
    $this->view->render('entrenadores', 'index');
  }

  //Visualiza Todas las Clases para el usuario que se quiera Inscribir (vista Deportista)
  public function clases(){
    $misclasesGrupales = $this->claseMapper->misClasesGrupales($_SESSION["currentuser"]);//Deportista Logueado
    foreach ($misclasesGrupales as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('misclasesGrupales', $misclasesGrupales);

    $misclasesParticulares = $this->claseMapper->misClasesParticulares($_SESSION["currentuser"]);//Deportista Logueado
    foreach ($misclasesParticulares as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('misClasesParticulares', $misclasesParticulares);

    $clasesGrupales = $this->claseMapper->findAllGrupales();
    foreach ($clasesGrupales as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('clasesGrupales', $clasesGrupales);

    $clasesParticulares = $this->claseMapper->findAllParticulares();
    foreach ($clasesParticulares as $clase) {
      $reserva = $this->reservaMapper->getReserva($clase->getReserva());
      $clase->setFecha($reserva["fecha"]);
    }
    $this->view->setVariable('clasesParticulares', $clasesParticulares);
    //    /view/clases/showall.php
    $this->view->render('clases', 'showall_user');
  }


  //Crea Clase
  public function add(){
    $clase = new Clase();
    if(isset($_POST["maxAlum"]) & isset($_POST["fecha"])){
      if($this->reservaMapper->pistasOcupadas($_POST["fecha"])<5){     //P

        //Cambiar formato a la fecha
        $fecha = date("Y-m-d H:i:s" , $_POST["fecha"]);

        //Crear Reserva
        $reserva = new Reserva();
        $reserva->setFecha($fecha);
        $reserva->setPista("1");
        $idReserva = $this->reservaMapper->addClase($reserva);  //Reserva la pista para la clase
        //CREAR cLASE
        $clase->setLogin($_SESSION["currentuser"]);//Login Entrenador Logueado $_SESSION["currentuser"]??
        $clase->setReserva($idReserva);
        if($_POST["maxAlum"] > 1){
          $clase->setRol("GRUPAL");
          $idClase = $this->claseMapper->crear($clase); //crea en la tabla clase
          $this->claseMapper->crearGrupal($idClase, $_POST["maxAlum"], $_POST["descripcion"]); //Crea en la tabla Clase_Grupal

          $this->view->setFlash("Clase ".$clase->getReserva()." successfully added.");
        }else {
          $clase->setRol("PARTICULAR");
          $idClase = $this->claseMapper->crear($clase); //crea en la tabla CLASE
          //$this->claseMapper->crearParticular($idClase, $clase->getLogin());
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
//Falta validacion
  public function inscribirse(){
    if (isset($_GET["idClase"])) {

      if (!$this->claseMapper->existeClaseId($_GET["idClase"])) {
        $errors = array();
        $errors["reserva"] = "Clase no existe";
        $this->view->setVariable("errors", $errors);
      }else{
        $clase = $this->claseMapper->getClase($_GET["idClase"]);
        if($clase["rol"] == "GRUPAL"){
          $claseGrupal = $this->claseMapper->getClaseGrupal($_GET["idClase"]);
          $numAlum = $this->claseMapper->getNumAlum($_GET["idClase"]);
          if ($numAlum < $claseGrupal["maxAlumnos"]) {                            //Comprobamos si hay plazas libres
            $this->claseMapper->inscribirGrupal($_GET["idClase"], $_SESSION["currentuser"]);
          }else {
            $errors["maxAlum"] = "Clase Completa";
            $this->view->setVariable("errors", $errors);
          }

      }elseif ($clase["rol"] == "PARTICULAR") {
        $this->claseMapper->inscribirParticular(($_GET["idClase"]), $_SESSION["currentuser"]);
      }
      $this->view->redirect("clase", "clases");
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
    $this->claseMapper->desinscribir($_GET["idClase"], $_SESSION["currentuser"], $clase["rol"]);
    $this->view->redirect("clase", "clases");
  }
}
}


}

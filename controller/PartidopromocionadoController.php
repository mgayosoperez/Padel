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

}


 ?>

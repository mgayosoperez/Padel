<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Campeonato/CampeonatoMapper.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionadoMapper.php");
require_once(__DIR__."/../model/PartidoPromocionado/PartidoPromocionado.php");

require_once(__DIR__."/../model/Pareja/ParejaMapper.php");
require_once(__DIR__."/../model/Pareja/Pareja.php");

require_once(__DIR__."/../model/PlayOffs/PlayOffsMapper.php");

require_once(__DIR__."/../model/LigaRegular/LigaRegularMapper.php");
require_once(__DIR__."/../model/LigaRegular/LigaRegular.php");

require_once(__DIR__."/../model/Pista/PistaMapper.php");

require_once(__DIR__."/../model/Grupo/GrupoMapper.php");

require_once(__DIR__."/../model/Enfrentamiento/EnfrentamientoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class AdminController extends BaseController {


	private $DeportistaMapper;

	public function __construct() {
		parent::__construct();
		$this->PlayOffsMapper = new PlayOffsMapper();
		$this->ParejaMapper = new ParejaMapper();
		$this->LigaRegularMapper = new LigaRegularMapper();
		$this->GrupoMapper = new GrupoMapper();
		$this->CampeonatoMapper = new CampeonatoMapper();
		$this->PartidoPromocionadoMapper = new PartidoPromocionadoMapper();
		$this->PistaMapper = new PistaMapper();
	}

	public function index(){
		$this->view->render("admin", "index");			
	}
	public function partidoPromocionado(){

		$this->view->render("admin", "promocionado");
	}	

	public function addPartidoPromocionado(){
		$partidoPromocionado = new PartidoPromocionado();
		$partidoPromocionado->setFecha($_POST["fecha"]);
		$this->PartidoPromocionadoMapper->add($partidoPromocionado);
		$this->view->redirect("admin", "showPartidos");
	}
	public function showPartidos(){
		$datos = $this->PartidoPromocionadoMapper->verDisponiblesAdmin();
		$this->view->setVariable("datos",$datos,true);	
		$this->view->render("admin", "showPartidos");
	}

	public function borrarPartido(){
		$this->PartidoPromocionadoMapper->delete($_GET["idPartido"]);
		$this->view->redirect("admin", "showPartidos");
	}

	public function campeonatos(){
		$campeonato = $this->CampeonatoMapper->getAllCapeonatos();
		$this->view->setVariable("campeonato", $campeonato, true);
		$this->view->render("campeonato", "showAllAdmin");
	}

	public function crearCampeonato(){
		$this->view->render("campeonato","crearCampeonato");
	}

	public function addCampeonato(){
		$campeonato = new Campeonato();
		$campeonato->setNombre($_POST["nombre"]);
		$campeonato->setFechaInicio($_POST["fechaInicio"]);
		$campeonato->setFechaFin($_POST["fechaFin"]);
		$this->CampeonatoMapper->add($campeonato);
		$this->view->redirect("admin", "campeonatos"); 
	}

	public function deleteCampeonato(){
		$this->CampeonatoMapper->delete($_GET["idCampeonato"]);
		$this->view->redirect("admin", "campeonatos"); 
	}


	public function generarLigaRegular(){
		for ($i=0; $i <5 ; $i++) { 
			switch ($i) {
				case 0:
					$this->lesGrupes("1","MASCULINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
				case 1:
					$this->lesGrupes("2","MASCULINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
				case 2:
					$this->lesGrupes("3","MASCULINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
				case 3:
					$this->lesGrupes("1","FEMENINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
				case 4:
					$this->lesGrupes("2","FEMENINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
				case 5:
					$this->lesGrupes("3","FEMENINA",$_GET["idCampeonato"],$_GET["fechaFin"]);
					break;
			}
		}
		$datos=$this->ParejaMapper->showAll($_GET["idCampeonato"]);
		$this->view->setVariable("grupos", $datos, true);
		$this->view->render("admin","grupos");
	}

	public function cuatroMeses($fecha){
		$date = new DateTime($fecha);
		$mill = $date->getTimestamp();
		$mill= $mill+(86400*120);
		$fieso = "Y-m-d ";
		$toret = date($fieso ,$mill);
		return $toret;

	}

	public function gestionarLigas(){
		$idC = $_GET["idCampeonato"];
		$ligas = $this->LigaRegularMapper->getLigaDeUnCampeonato($idC);
		$ligasConAlgo = array();
		foreach ($ligas as $key => $value) {
				array_push($ligasConAlgo, $value["idLiga"]);
		}
		$this->view->setVariable("ligas", $ligasConAlgo, true);
		$this->view->render("campeonato", "showLigasRegulares");
	}

	public function parejaVictoria(){
		$idC = $_GET["idCampeonato"];
		$capitan = $_GET["Capitan"];
		$puntos = $_GET["Puntos"];
		$total = $puntos+3;
		$this->ParejaMapper->añadirPuntos($capitan,$idC,$total);
		$ligas = $this->LigaRegularMapper->getLigaDeUnCampeonato($idC);
		$ligasConAlgo = array();		
		foreach ($ligas as $key => $value) {
				array_push($ligasConAlgo, $value["idLiga"]);
		}
		$this->view->setVariable("ligas", $ligasConAlgo, true);
		$this->view->render("campeonato", "showLigasRegulares");
	}

	public function parejaEmpate(){
		$idC = $_GET["idCampeonato"];
		$capitan = $_GET["Capitan"];
		$puntos = $_GET["Puntos"];
		$total = $puntos+1;
		$this->ParejaMapper->añadirPuntos($capitan,$idC,$total);
		$ligas = $this->LigaRegularMapper->getLigaDeUnCampeonato($idC);
		$ligasConAlgo = array();
		foreach ($ligas as $key => $value) {
				array_push($ligasConAlgo, $value["idLiga"]);
		}
		$this->view->setVariable("ligas", $ligasConAlgo, true);
		$this->view->render("campeonato", "showLigasRegulares");
	}

	public function lesGrupes($nivel,$categoria,$idCampeonato,$fechaFin){
		$datos = $this->ParejaMapper->grupo($categoria,$nivel,$idCampeonato);
		if((count($datos)>=8)){

						$ligaRegular = new LigaRegular();
						$ligaRegular->setNivel($nivel);
						$ligaRegular->setCategoria($categoria);
						$ligaRegular->setIdCampeonato($idCampeonato);
						$ligaRegular->setFechaInicio($fechaFin);
						$ligaRegular->setFechaFin($this->cuatroMeses($fechaFin));
						$ligaRegularid = $this->LigaRegularMapper->add($ligaRegular); 


						if((!(count($datos)%8==(5||6||7))&&((count($datos)/8)==1))){
							$grupoId = $this->GrupoMapper->add($ligaRegularid);
							$pareja = new Pareja();
							foreach ($datos as $key => $value) {
								$pareja = new Pareja($value["capitan"],$value["pareja"],$value["idCampeonato"],$value["categoria"],$value["nivel"],$grupoId,$value["puntos"]);
								$this->ParejaMapper->modify($pareja);
							}
						}else{
							if((count($datos)%8==(5||6||7))&&((count($datos)/8)==1)){
								while(!count($datos)%12==0){
									unset($datos[count($datos)]);
								}
								if((count($datos)%12==0)&&((count($datos)/8)==1)){
									$grupoId = $this->GrupoMapper->add($ligaRegularid);
									$pareja = new Pareja();
									foreach ($datos as $key => $value) {
										$pareja = new Pareja($value["capitan"],$value["pareja"],$value["idCampeonato"],$value["categoria"],$value["nivel"],$grupoId,$value["puntos"]);
										$this->ParejaMapper->modify($pareja);
									}
								}
							}else{
								if((count($datos)/8)>1){
									$numGrupos =(count($datos)/8);
									$marginados = (count($datos)%8);
									for ($i=0; $i <intval($numGrupos) ; $i++) { 
										$grupoId = $this->GrupoMapper->add($ligaRegularid);
										$pareja = new Pareja();
										$j = 0;
										foreach ($datos as $key => $value) {
											if($j<8){
												$pareja = new Pareja($value["capitan"],$value["pareja"],$value["idCampeonato"],$value["categoria"],$value["nivel"],$grupoId,$value["puntos"]);
												$this->ParejaMapper->modify($pareja);
												unset($datos[$key]);
												$j = $j + 1;
											}else{
												break;
											}
										}
									}

									if(count($datos)==$marginados){
										while(!(count($datos)==0)){
											for($i=0; $i < intval($numGrupos) ; $i++){
												if(!(count($datos)==0)){
													$index = array_key_first($datos);
													$grupo = intval($grupoId)-$i;
													$pareja = new Pareja($datos[$index]["capitan"],$datos[$index]["pareja"],$datos[$index]["idCampeonato"],$datos[$index]["categoria"],$datos[$index]["nivel"],$grupo,$datos[$index]["puntos"]);
													$this->ParejaMapper->modify($pareja);
													unset($datos[$index]);
												}
											}
										}	
									}
								}
							}

						}
					}else{
						
					}
	}

	public function generarPlayOffs() {
		$idC=$_GET["idCampeonato"];
		$this->view->setVariable("idC",$idC,true);
		if(!$this->PlayOffsMapper->existe($idC)){
			$ligas = $this->LigaRegularMapper->getLigaDeUnCampeonato($idC);
			foreach ($ligas as $key => $value){

				$grupos = $this->GrupoMapper->getGruposLiga($value["idLiga"]);
				$liga =	$this->LigaRegularMapper->getLiga($value["idLiga"]);
				$fechaInicioPlayOffs = $liga[0]["fechaFin"];
				$fechaFinPLayOffs = $this->cuatroMeses($fechaInicioPlayOffs);
				$categoriaPlayOffs = $liga[0]["categoria"];
				$nivelPlayOffs = $liga[0]["nivel"];
				foreach ($grupos as $ke => $valu) {

					$idPlayOff = $this->PlayOffsMapper->add($fechaInicioPlayOffs, $fechaFinPLayOffs, $categoriaPlayOffs, $nivelPlayOffs, $idC);
					$this->GrupoMapper->update($valu["idGrupo"],$idPlayOff);
					$parejas = $this->ParejaMapper->cogerOchoParejas($idC,$valu["idGrupo"]);
					foreach ($parejas as $k => $val) {

						$this->PlayOffsMapper->añadirParejas($val["capitan"], $idPlayOff);
					}
				}
				
			}
		}
		$this->view->render("campeonato", "showPlayOffsAdmin");
	} 

	public function ganador(){
		$this->PlayOffsMapper->updateGanador($_GET["fase"],$_GET["idCap"],$_GET["idP"]);		
		$this->view->render("campeonato", "showPlayOffsAdmin");
	}

	public function verPistas(){
		$datos = $this->PistaMapper->showPistas();
		$this->view->setVariable("datos",$datos,true);	
		$this->view->render("admin", "showPistas");
	}


	public function logout(){

		session_destroy();
		$this->view->redirect("init", "index");
	}

	

}

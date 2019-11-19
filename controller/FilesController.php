<?php

require_once(__DIR__."/../model/FilesMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class FilesController extends BaseController {


	public function __construct() {
		parent::__construct();
		$actualuser= $_SESSION["currentuser"];
		$this->FilesMapper = new FilesMapper($_SESSION["currentuser"]);
		$this->view->setVariable("rutaActual",$actualuser);

	}

	
	public function index(){
		$rutaActual=$_SESSION["currentPath"];
		$files = $this->FilesMapper->findFilesById($rutaActual);
		$directories =  $this->FilesMapper->findDirectoriesById($rutaActual);
		$this->view->setVariable("files", $files);
		$this->view->setVariable("directories", $directories);
		$this->view->render("files", "index");
	}





	public function addFile() {
		$direcActual=$_POST["ruta"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual";
		}else{
			$ruta="$direcActual";
		}

		foreach ($_FILES["files"]["error"] as $key => $error) {

    		if ($error == UPLOAD_ERR_OK) {
       			$tmp_name = $_FILES["files"]["tmp_name"][$key];
        		$name = basename($_FILES["files"]["name"][$key]);
        		move_uploaded_file($tmp_name, "$ruta/$name");
        	}
        }

        $this->view->redirect("files", "index");
		
	}

	public function addDirectory() {

		$name=$_POST["name"];
		$direcActual=$_POST["ruta"];
		$actualuser= $_SESSION["currentuser"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$name";
		}else{
			$ruta="$direcActual/$name";
		}

		if(!file_exists ( $ruta )){
			mkdir($ruta, 0777, true);
		}

		$this->view->redirect("files", "index");
	}

	public function deleteF() {

		$name=$_GET["fic"];
		$direcActual=$_GET["ruta"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$name";
		}else{
			$ruta="$direcActual/$name";
		}

		unlink($ruta);
		$this->view->redirect("files", "index");
	}
	public function deleteD() {

		$name=$_GET["fic"];
		$direcActual=$_GET["ruta"];
		$actualuser= $_SESSION["currentuser"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$name";
		}else{
			$ruta="$direcActual/$name";
		}

		rmdir($ruta);
		$this->view->redirect("files", "index");
	}

	public function download(){

		$name=$_GET["name"];
		$direcActual=$_GET["ruta"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$name";
		}else{
			$ruta="$direcActual/$name";
		}

		if (file_exists($ruta)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($ruta).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($ruta));
		    readfile($ruta);
		    exit;
		    $this->view->redirect("files", "index");
		}
	}

	public function open(){

		$direc=$_GET["dir"];
		$direcActual=$_GET["ruta"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$direc";
		}else{
			$ruta="$direcActual/$direc";
		}
		
		$files = $this->FilesMapper->findFilesById($ruta);
		$directories =  $this->FilesMapper->findDirectoriesById($ruta);

		$this->view->setVariable("files", $files);
		$this->view->setVariable("directories", $directories);
		$this->view->setVariable("rutaActual",$ruta);
		$this->view->render("files", "index");
		
	}

	public function share(){
		$direc=$_GET["fic"];
		$direcActual=$_GET["ruta"];

		if(!(strpos($direcActual, 'uploads') !== false)){
			$ruta="uploads/$direcActual/$direc";
		}else{
			$ruta="$direcActual/$direc";
		}

		$link = "<script>window.open('http://localhost/TSWBEE/view/files/share.php?ruta=$ruta')</script>";
		echo $link;

	}
}

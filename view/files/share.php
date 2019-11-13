<?php
$share = $_GET["ruta"];
chdir("../../");
print($share);
if(!(strpos($share, 'uploads') !== false)){
			$ruta="uploads/$share";
		}else{
			$ruta="$share";
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
		    
		}

?>
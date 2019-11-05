<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$file = $view->getVariable("files");
$directories = $view->getVariable("directories");
$currentuser = $view->getVariable("currentusername");
$errors = $view->getVariable("errors");
$rutaActual =$view->getVariable("rutaActual");
$rutaU= $rutaActual;
if((strpos($rutaActual, 'uploads/') !== false)){
	$rutaU=str_replace("uploads/", "", $rutaU);
}

?><div class="section">
		<div class="container">
			<div class="row border-bottom mt-5">
				<h3 class="col-9"><?=$rutaU?></h3>
				<div class="container" role="group" aria-label="Basic example">
					<form action="index.php?controller=files&amp;action=addDirectory" method="POST">
						<input type="text" name="name" placeholder="Directory name">
						<input type="hidden" name="ruta" value="<?=$rutaActual?>">
						<button type="submit" class="btn"><img src="icon/add.png" height="24" width="24"></button>
					</form>
	  				
	  				<form action="index.php?controller=files&amp;action=addFile" method="POST"enctype="multipart/form-data">
	  				<input type="file" name="files[]" multipl></input>
	  				<input type="hidden" name="ruta" value="<?=$rutaActual?>">
	  				<button type="submit" class="btn"><img src="icon/upload.png" height="24" width="24"></button>	  				
	  				</form>
	  			</div> 
			</div>
			<div class="row">
			<?php
				foreach($file as $key){
					if($key!="."&&$key!=".."){
						$laRuta="$rutaActual/$key";
						?>
						<div class="col-sm-4 mt-5 text-center">
					<img src="icon/file.png" height="80" width="80">
					<p><?=$key?></p>
					<div class="container">
						<button type="button" class="btn"><img src="icon/delete.png" height="24" width="24" onclick="location.href='index.php?controller=files&amp;action=deleteF&amp;fic=<?=$key?>&amp;ruta=<?=$rutaActual?>'"></button>
		  				<button type="button" class="btn"><img src="icon/share.png" height="24" width="24" onclick="alert('http://localhost/TSWBEE/view/files/share.php?ruta=<?=$laRuta?>')"></button>
		  				<button type="button" class="btn"><img src="icon/download.png" height="24" width="24" onclick="location.href='index.php?controller=files&amp;action=download&amp;name=<?=$key?>&amp;ruta=<?=$rutaActual?>'"></button>
					</div>
					
				</div>
					
					
					
				<?php } } ?>

			<?php
				foreach($directories as $key){
					if($key!="."&&$key!=".."){
						?>
						<div class="col-sm-4 mt-5 text-center">
					<img src="icon/folder.png" height="80" width="80" ondblclick="location.href='index.php?controller=files&amp;action=open&amp;dir=<?=$key?>&amp;ruta=<?=$rutaActual?>'">
					<p><?=$key?></p>
					<div class="container">
						<button type="button" class="btn" onclick="location.href='index.php?controller=files&amp;action=deleteD&amp;fic=<?=$key?>&amp;ruta=<?=$rutaActual?>'"><img src="icon/delete.png" height="24" width="24"></button>
		  				
					</div>
				</div>
					
					
					
				<?php } } ?>


		
			
				
				
			</div>
		</div>
	</div>
	<p></p>


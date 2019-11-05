<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
if(isset($currentuser)){
?><!DOCTYPE html>
<html>
<head>
	<title>IDriBEE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.css">
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<!-- header -->
	<header>


			<nav class="navbar navbar-dark bg-dark text-light">
				<a class="navbar-brand" href="index.php?controller=files&amp;action=index">
  					<img src="icon/padel.png" height="45" width="45" class="mr-2" >IDriBEE
  				</a>

			  <form class="form-inline">
					<!--
			  	<select class="selectpicker show-tick">
  					<option ><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></option>
  					<option ><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></option>
					</select>-->

					<!--CurrentUser-->

			  	<div class="mr-5"><?=$_SESSION["currentuser"]?></div>

					<!-- Imagenes Idioma-->
					<a class="mr-4" href="index.php?controller=language&amp;action=change&amp;lang=es">
						<img src="./icon/espana.png" onclick='this.form.submit()' height="27" width="27">
					</a>
					<a class="mr-4" href="index.php?controller=language&amp;action=change&amp;lang=en">
							<img src="./icon/reino-unido.png" onclick='this.form.submit()' height="27" width="27">
					</a>
					<!-- Imagen Logout-->
					<a 	href="index.php?controller=users&amp;action=logout">
			    <img src="icon/out.png" height="27" width="27">
					</a>
			  </form>
			</nav>


	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>



</body>
</html>
<?php }else{

	$view->redirect("users", "login");
}?>

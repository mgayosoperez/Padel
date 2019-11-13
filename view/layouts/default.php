<?php

$view = ViewManager::getInstance();
$user = $_SESSION["currentuser"];
?><!DOCTYPE html>
<html>
<head>
	
	<title>Padelo</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.css">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>

	<header>

	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>



</body>
</html>
<?php ?>

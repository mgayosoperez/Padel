<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();

?><!DOCTYPE html>
<html>
<head>
	<title>IDriBEE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css\bootstrap-4.3.1-dist/css/bootstrap.css">
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<header>
	</header>
	<main>
		<!-- flash message -->
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>
		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>
	<footer>
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>
</body>
</html>

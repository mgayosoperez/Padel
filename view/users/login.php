<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
          					<div class="text-light">
          						<img src="icon/padel.png" height="45" width="45" class="mr-2" >IDriBEE
          					</div>
                    <div style="float: right">
                      <!-- Imagenes Idioma-->
            					<a href="index.php?controller=language&amp;action=change&amp;lang=es">
            						<img src="./icon/espana.png" onclick='this.form.submit()' height="27" width="27">
            					</a>
            					<a href="index.php?controller=language&amp;action=change&amp;lang=en">
            							<img src="./icon/reino-unido.png" onclick='this.form.submit()' height="27" width="27">
            					</a>
                    </div>

                    		<h2 class="text-light"><?= i18n("Login") ?></h2>
                    		<br>
                    		<form action="index.php?controller=users&amp;action=login" method="POST">
                    			<div class="form-group">
	                              	<input type="text" class="form-control" name="username" placeholder="<?= i18n("Username")?>">
	                            </div>
	                            <div class="form-group">
	                                <input type="password" class="form-control" name="passwd" placeholder="<?= i18n("Password")?>">
	                            </div>
	                            <div>
	                            	<h8 class="text-light"><?= isset($errors["general"])?$errors["general"]:"" ?></h8>
	                            </div>
	                            <br>
	                            <button type="button" id="sendlogin" class="btn btn-dark"><a class="text-light" href="index.php?controller=users&amp;action=register"><?= i18n("Crear cuenta")?></a></button>
	                            <input type="submit" value="<?= i18n("Login") ?>" class="btn btn-dark"></input>
                        	</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

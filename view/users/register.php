<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Register");
?>
	<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                    	<div class="text-light"><img src="icon/padel.png" height="45" width="45" class="mr-2" >IDriBEE</div>
											<div style="float: right">
												<!-- Imagenes Idioma-->
												<a href="index.php?controller=language&amp;action=change&amp;lang=es">
													<img src="./icon/espana.png" onclick='this.form.submit()' height="27" width="27">
												</a>
												<a href="index.php?controller=language&amp;action=change&amp;lang=en">
														<img src="./icon/reino-unido.png" onclick='this.form.submit()' height="27" width="27">
												</a>
											</div>
                    	<h2 class="text-light"><?= i18n("Register")?></h2>
                    	<br>
                    	<form action="index.php?controller=users&amp;action=register" method="POST">
                    		<div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="<?= i18n("Username")?>">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="passwd" placeholder="<?= i18n("Password")?>">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="<?= i18n("E-mail")?>">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="nombre" placeholder="<?= i18n("Nombre")?>">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="telefono" placeholder="<?= i18n("Telefono")?>">
                            </div>

                            <div>
	                            <br>
	                            <h8 class="text-light"><?= isset($errors["telefono"])?i18n($errors["telefono"]):"" ?>
									<?= isset($errors["nombre"])?i18n($errors["nombre"]):"" ?>
									<?= isset($errors["email"])?i18n($errors["email"]):"" ?>
									<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?>
									<?= isset($errors["username"])?i18n($errors["username"]):"" ?>
								</h8>
								<br>
                            </div>

                            <input type="submit" id="sendlogin" class="btn btn-dark" value="<?= i18n("Register")?>"></input>

                    	</form >

                    </div>
                </div>
            </div>
    	</div>
	</div>

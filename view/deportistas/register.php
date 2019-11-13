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
                    	<div class="text-light"><img src="icon/padel.png" height="45" width="45" class="mr-2" >Padelo</div>
                    	<h2 class="text-light">Register</h2>
                    	<br>
                    	<form action="index.php?controller=deportista&amp;action=register" method="POST">
                    		<div class="form-group">
                                <input type="text" class="form-control" name="login" placeholder="Login">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="passwd" placeholder="Password">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="nombre" placeholder="Name">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="apellidos" placeholder="First name">
                            </div>
                             <div class="form-group">
                                <input type="text" class="form-control" name="dni" placeholder="DNI">
                            </div>
                             <div class="form-group text-light ml-3">
                             	<h6>Gender:</h6>
                             	<input type="radio" name="sexo" value="HOMBRE" checked> Male<br>
  								<input type="radio" name="sexo" value="MUJER"> Female<br>
                            </div>

                            <div>
	                            <br>
	                            <h8 class="text-light"><?= isset($errors["login"])?i18n($errors["login"]):"" ?>
									<?= isset($errors["nombre"])?i18n($errors["nombre"]):"" ?>
									<?= isset($errors["apellido"])?i18n($errors["apellido"]):"" ?>
									<?= isset($errors["sexo"])?i18n($errors["sexo"]):"" ?>
									<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?>
									<?= isset($errors["dni"])?i18n($errors["dni"]):"" ?>
								</h8>
								<br>
                            </div>

                            <input type="submit" id="sendlogin" class="btn btn-dark" value="Register"></input>

                    	</form >

                    </div>
                </div>
            </div>
    	</div>
	</div>

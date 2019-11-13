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
          						<img src="icon/padel.png" height="45" width="45" class="mr-2" >Padelo
          					</div>
                    		<h2 class="text-light">Login</h2>
                    		<br>
                    		<form action="index.php?controller=deportista&amp;action=login" method="POST">
                    			<div class="form-group">
	                              	<input type="text" class="form-control" name="login" placeholder="Username">
	                            </div>
	                            <div class="form-group">
	                                <input type="password" class="form-control" name="passwd" placeholder="Password">
	                            </div>
	                            <div>
	                            	<h8 class="text-light"><?= isset($errors["general"])?$errors["general"]:"" ?></h8>
	                            </div>
	                            <br>
	                            <button type="button" id="sendlogin" class="btn btn-dark"><a class="text-light" href="index.php?controller=deportista&amp;action=register">Crear cuenta</a></button>
	                            <input type="submit" value="Login" class="btn btn-dark"></input>
                        	</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

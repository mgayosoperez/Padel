<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("pista");
?>


<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h2 class="text-light">Crear Pista</h2>
                      <br>
                      <form action="index.php?controller=pista&amp;action=addPista" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="estado" placeholder="Estado de pista">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="superficie" placeholder="Tipo de Superficie">
                        </div>
                            <div>
                              <h8 class="text-light"><?php if(isset($errors["cam"])){echo $errors["cam"];}
                              if(isset($errors["login"])){echo $errors["login"];}?></h8>
                              <br>
                              <br>
                            </div>
                            <input type="submit" class="btn btn-dark" value="Crear Pista"></input>

                      </form >

                    </div>
                </div>
            </div>
      </div>
  </div>
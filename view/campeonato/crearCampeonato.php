<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");

require_once(__DIR__."/../../view/navBar/admin.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");
$datos=$view->getVariable("cosa");
?>


<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h2 class="text-light">Crear un Campeonato</h2>
                      <br>
                      <form action="index.php?controller=admin&amp;action=addCampeonato" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre campeonato">
                        </div>
                            <div class="form-group">
                            <input type="date" class="form-control" name="fechaInicio" placeholder="Fecha Inicio">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fechaFin" placeholder="Fecha Fin">
                        </div>
                            <div>
                              <h8 class="text-light"><?php if(isset($errors["cam"])){echo $errors["cam"];}
                              if(isset($errors["login"])){echo $errors["login"];}?></h8>
                              <br>
                              <br>
                            </div>
                            <input type="submit" id="sendFecha" class="btn btn-dark" value="Crear campeonato"></input>

                      </form >

                    </div>
                </div>
            </div>
      </div>
  </div>
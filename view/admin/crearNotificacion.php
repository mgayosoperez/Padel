<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../view/navBar/admin.php");
$view = ViewManager::getInstance();
$user = $_SESSION["currentuser"];
?>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:80vh;">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                            <div class="text-light">
                                <img src="icon/padel.png" height="45" width="45" class="mr-2" >Crear
                            </div>
                            <h2 class="text-light">Notificacion</h2>
                            <br>
                            <form action="index.php?controller=notificaciones&amp;action=addNotificacionAdmin" method="POST" id="usrform">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="destinatario" placeholder="Destinatario">
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="user" hidden value="<?=$user?>">
                                </div>
                                <div>
                                    <textarea rows="4" cols="40" name="texto" class="mt-3" form="usrform" maxlength="500" placeholder=" Notificacion"></textarea>
                                </div>
                                <br>
                                <input type="submit" value="Crear Notificacion" class="btn btn-dark"></input>
                            </form>
                            

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");

require_once(__DIR__."/../../view/navBar/deportista.php");

$view = ViewManager::getInstance();

// $idCampeonato = $view->getVariable("campeonatoid");
?>



<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                      <h2 class="text-light">Registrarse en campeonato</h2>
                      <br>
                      <form action="index.php?controller=campeonato&amp;action=inscribirse" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="pareja" placeholder="Pareja">
                        </div>
                            <div class="form-group text-light ml-3">
                              <h6>Nivel:</h6>
                              <input type="radio" name="nivel" value="1" checked> 1<br>
                              <input type="radio" name="nivel" value="2"> 2<br>
                              <input type="radio" name="nivel" value="3"> 3<br>
                         </div>
                            <div>
                              <h8 class="text-light"><?php if(isset($errors["cam"])){echo $errors["cam"];}
                              if(isset($errors["login"])){echo $errors["login"];}?></h8>
                              <br>
                              <br>
                            </div>
                            <input type="submit" id="sendlogin" class="btn btn-dark" value="Register"></input>

                      </form >

                    </div>
                </div>
            </div>
      </div>
  </div>
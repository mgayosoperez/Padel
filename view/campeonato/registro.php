<?php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/Reserva/Reserva.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
// $idCampeonato = $view->getVariable("campeonatoid");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=deportista&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reservas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=reserva">Crear reserva</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showReservas">Ver reservas</a>
          <a class="dropdown-item" href="index.php?controller=deportista&amp;action=showPromocionados">Partidos Promocionados</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=deportista&amp;action=campeonatos">Campeonatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesGrupales">Clases Grupales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=clase&amp;action=clasesParticulares">Clases Particulares</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=deportista&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


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
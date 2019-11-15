<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];
$view->setVariable("title", "index");

$fies = "d M Y H i";
$fieso = "Y-m-d ";

$fecha = date($fies ,time());
$Dfecha = explode(' ', $fecha);
$HoraActual =$Dfecha[3];

$fechas = array();
$fechato = array();

for($z = 0; $z < 7; $z++){
  $fechatito = date($fieso ,time()+(86400*$z));

  array_push($fechato, $fechatito);

  $fecha=date($fies ,time()+(86400*$z));
  $Dfecha = explode(' ', $fecha);
  array_push($fechas, $Dfecha[0]);
}

function fondoHora(int $horis){
  $fies = "d M Y H i";
  $fecha = date($fies ,time());
  $Dfecha = explode(' ', $fecha);
  $HoraActual =$Dfecha[3];
    if($horis<$HoraActual){
      echo  "class='bg-dark'";
  }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="">Reservas<span class="sr-only"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Campeonatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Clases</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
   	<div class="mr-5 text-light"><?= $user?>	</div>
    <img src="icon/out.png" height="27" width="27">
  </form>
</nav>

<body>
	<div class="section">
		<table class="table mt-5 text-center table-bordered ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Horas</th>
      <th scope="col"  <?php fondoHora(8);?> id="th1"><?= $fechas[0]?></th>
      <th scope="col" id="th2"><?= $fechas[1]?></th>
      <th scope="col" id="th3"><?= $fechas[2]?></th>
      <th scope="col" id="th4"><?= $fechas[3]?></th>
      <th scope="col" id="th5"><?= $fechas[4]?></th>
      <th scope="col" id="th6"><?= $fechas[5]?></th>
      <th scope="col" id="th7"><?= $fechas[6]?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="bg-dark text-light ">8:00/10:00</th>
      <td id="1"  onclick="toinput( '<?php echo($fechato[0]);?>08:00'  , '1')"></td>
      <td id="2"  onclick="toinput( '<?php echo($fechato[1]);?>08:00'  , '2')"></td>
      <td id="3"  onclick="toinput( '<?php echo($fechato[2]);?>08:00'  , '3')"></td>
      <td id="4"  onclick="toinput( '<?php echo($fechato[3]);?>08:00'  , '4')"></td>
      <td id="5"  onclick="toinput( '<?php echo($fechato[4]);?>08:00'  , '5')"></td>
      <td id="6"  onclick="toinput( '<?php echo($fechato[5]);?>08:00'  , '6')"></td>
      <td id="7"  onclick="toinput( '<?php echo($fechato[6]);?>08:00'  , '7')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">10:00/12:00</th>
      <td id="8"    class="bg-dark" onclick="toinput('lunes-10:00/12:00', '8')"></td>
      <td id="9"    onclick="toinput('martes-10:00/12:00', '9')"></td>
      <td id="10"   onclick="toinput('miercoles-10:00/12:00', '10')"></td>
      <td id="11"   onclick="toinput('jueves-10:00/12:00', '11')"></td>
      <td id="12"   onclick="toinput('viernes-10:00/12:00', '12')"></td>
      <td id="13"   onclick="toinput('sabado-10:00/12:00', '13')"></td>
      <td id="14"   onclick="toinput('domingo-10:00/12:00', '14')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">12:00/14:00</th>
      <td id="15"  onclick="toinput('lunes-12:00/14:00', '15')"></td>
      <td id="16"  onclick="toinput('martes-12:00/14:00', '16')"></td>
      <td id="17"  onclick="toinput('miercoles-12:00/14:00', '17')"></td>
      <td id="18"  onclick="toinput('jueves-12:00/14:00', '18')"></td>
      <td id="19"  onclick="toinput('viernes-12:00/14:00', '19')"></td>
      <td id="20"  onclick="toinput('sabado-12:00/14:00', '20')"></td>
      <td id="21"  onclick="toinput('domingo-12:00/14:00', '21')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">14:00/16:00</th>
      <td id="22"   onclick="toinput('lunes-14:00/16:00', '22')"></td>
      <td id="23"   onclick="toinput('martes-14:00/16:00', '23')"></td>
      <td id="24"   onclick="toinput('miercoles-14:00/16:00', '24')"></td>
      <td id="25"   onclick="toinput('jueves-14:00/16:00', '25')"></td>
      <td id="26"   onclick="toinput('viernes-14:00/16:00', '26')"></td>
      <td id="27"   onclick="toinput('sabado-14:00/16:00', '27')"></td>
      <td id="28"   onclick="toinput('domingo-14:00/16:00', '28')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">16:00/18:00</th>
      <td id="29"  onclick="toinput('lunes-16:00/18:00', '29')"></td>
      <td id="30"  onclick="toinput('martes-16:00/18:00', '30')"></td>
      <td id="31"  onclick="toinput('miercoles-16:00/18:00', '31')"></td>
      <td id="32"  onclick="toinput('jueves-16:00/18:00', '32')"></td>
      <td id="33"  onclick="toinput('viernes-16:00/18:00', '33')"></td>
      <td id="34"  onclick="toinput('sabado-16:00/18:00', '34')"></td>
      <td id="35"  onclick="toinput('domingo-16:00/18:00', '35')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">18:00/20:00</th>
      <td id="36"  onclick="toinput('lunes-18:00/20:00', '36')"></td>
      <td id="37"  onclick="toinput('martes-18:00/20:00', '37')"></td>
      <td id="38"  onclick="toinput('miercoles-18:00/20:00', '38')"></td>
      <td id="39"  onclick="toinput('jueves-18:00/20:00', '39')"></td>
      <td id="40"  onclick="toinput('viernes-18:00/20:00', '40')"></td>
      <td id="41"  onclick="toinput('sabado-18:00/20:00', '41')"></td>
      <td id="42"  onclick="toinput('domingo-18:00/20:00', '42')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">20:00/22:00</th>
      <td id="43"  onclick="toinput('lunes-20:00/22:00', '43')"></td>
      <td id="44"  onclick="toinput('martes-20:00/22:00', '44')"></td>
      <td id="45"  onclick="toinput('miercoles-20:00/22:00', '45')"></td>
      <td id="46"  onclick="toinput('jueves-20:00/22:00', '46')"></td>
      <td id="47"  onclick="toinput('viernes-20:00/22:00', '47')"></td>
      <td id="48"  onclick="toinput('sabado-20:00/22:00', '48')"></td>
      <td id="49"  onclick="toinput('domingo-20:00/22:00', '49')"></td>
    </tr>
  </tbody>
</table>

<form  action="index.php?controller=reserva&amp;action=addReserva" method="POST" class="text-center">
  <input type="text" name="fecha" id="input" >
   <input type="submit" value="Realizar reserva" class="btn btn-yagami mx-auto" style="width: 200px;"></input>
</form>
	</div>
<script type="text/javascript">
  var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); 
var yyyy = today.getFullYear();
var hh = today.getHours();
var min = today.getMinutes();
today = mm + '/' + dd + '/' + yyyy + ' ' +hh+':'+min ;
document.getElementById("th1").value="asdasdas";
for(z=1;z<7;z++){
  document.getElementById("th"+z).value=dd+z-1;
}
  function toinput(s, i){
    if(!document.getElementById(i).hasAttribute("class")){
      for(z = 1; z < 50; z++){
        if(!(document.getElementById(z).getAttribute("class") === null)){
          if(!document.getElementById(z).getAttribute("class").includes("bg-dark")){
            document.getElementById(z).removeAttribute("class");
          }
        }
      }
      document.getElementById(i).setAttribute("class","bg-success");
      document.getElementById("input").value=s;
    }
  }


</script>
<?php
//file: view/users/register.php
require_once(__DIR__."/../../model/Reserva/ReservaMapper.php");
require_once(__DIR__."/../../model/Clase/ClaseMapper.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $_SESSION["currentuser"];

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
function horaOcupada($fecha){
  $ReservaMapper = new ReservaMapper();
  $claseMapper = new ClaseMapper();
  if($ReservaMapper->pistasOcupadas($fecha)>=5 || $claseMapper->entrenadorHasClase($fecha, $_SESSION["currentuser"])){
      echo  "class='bg-dark'";
  }
}


function fondoHora(int $horis){
  $fies = "d M Y H i";
  $fecha = date($fies ,time());
  $Dfecha = explode(' ', $fecha);
  $HoraActual =$Dfecha[3];
    if($horis<=$HoraActual){
      echo  "class='bg-dark'";
  }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controller=clase&amp;action=index"><img src="icon/padel.png" height="50" width="50" class="mr-2">Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Clases
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=add">Crear mis clases</a>
          <a class="dropdown-item" href="index.php?controller=clase&amp;action=showClases">Ver mis clases</a>
        </div>
      </li>
    </ul>
  </div>
  <form class="form-inline">
    <div class="mr-5 text-light"><?= $user?></div>
    <a  href="index.php?controller=entrenador&amp;action=logout"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>

<body>
	<div class="section">
		<table class="table mt-5 text-center table-bordered ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Horas/Dia</th>
      <th scope="col" id="th1"><?= $fechas[0]?></th>
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
      <td id="1"  <?php fondoHora(8);?> <?php horaOcupada("$fechato[0] 08:00");?> onclick="toinput( '<?php echo($fechato[0]);?>08:00'  , '1')"></td>
      <td id="2"  <?php horaOcupada("$fechato[1] 08:00");?> onclick="toinput( '<?php echo($fechato[1]);?>08:00'  , '2')"></td>
      <td id="3"  <?php horaOcupada("$fechato[2] 08:00");?> onclick="toinput( '<?php echo($fechato[2]);?>08:00'  , '3')"></td>
      <td id="4"  <?php horaOcupada("$fechato[3] 08:00");?> onclick="toinput( '<?php echo($fechato[3]);?>08:00'  , '4')"></td>
      <td id="5"  <?php horaOcupada("$fechato[4] 08:00");?> onclick="toinput( '<?php echo($fechato[4]);?>08:00'  , '5')"></td>
      <td id="6"  <?php horaOcupada("$fechato[5] 08:00");?> onclick="toinput( '<?php echo($fechato[5]);?>08:00'  , '6')"></td>
      <td id="7"  <?php horaOcupada("$fechato[6] 08:00");?> onclick="toinput( '<?php echo($fechato[6]);?>08:00'  , '7')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">10:00/12:00</th>
      <td id="8"    <?php fondoHora(10);?> <?php horaOcupada("$fechato[0] 10:00");?> onclick="toinput('<?php echo($fechato[0]);?>10:00', '8')"></td>
      <td id="9"    <?php horaOcupada("$fechato[1] 10:00");?> onclick="toinput('<?php echo($fechato[1]);?>10:00', '9')"></td>
      <td id="10"   <?php horaOcupada("$fechato[2] 10:00");?> onclick="toinput('<?php echo($fechato[2]);?>10:00', '10')"></td>
      <td id="11"   <?php horaOcupada("$fechato[3] 10:00");?> onclick="toinput('<?php echo($fechato[3]);?>10:00', '11')"></td>
      <td id="12"   <?php horaOcupada("$fechato[4] 10:00");?> onclick="toinput('<?php echo($fechato[4]);?>10:00', '12')"></td>
      <td id="13"   <?php horaOcupada("$fechato[5] 10:00");?> onclick="toinput('<?php echo($fechato[5]);?>10:00', '13')"></td>
      <td id="14"   <?php horaOcupada("$fechato[6] 10:00");?> onclick="toinput('<?php echo($fechato[6]);?>10:00', '14')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">12:00/14:00</th>
      <td id="15"   <?php fondoHora(12);?> <?php horaOcupada("$fechato[0] 12:00");?> onclick="toinput('<?php echo($fechato[0]);?>12:00', '15')"></td>
      <td id="16"  <?php horaOcupada("$fechato[1] 12:00");?> onclick="toinput('<?php echo($fechato[1]);?>12:00', '16')"></td>
      <td id="17"  <?php horaOcupada("$fechato[2] 12:00");?> onclick="toinput('<?php echo($fechato[2]);?>12:00', '17')"></td>
      <td id="18"  <?php horaOcupada("$fechato[3] 12:00");?> onclick="toinput('<?php echo($fechato[3]);?>12:00', '18')"></td>
      <td id="19"  <?php horaOcupada("$fechato[4] 12:00");?> onclick="toinput('<?php echo($fechato[4]);?>12:00', '19')"></td>
      <td id="20"  <?php horaOcupada("$fechato[5] 12:00");?> onclick="toinput('<?php echo($fechato[5]);?>12:00', '20')"></td>
      <td id="21"  <?php horaOcupada("$fechato[6] 12:00");?> onclick="toinput('<?php echo($fechato[6]);?>12:00', '21')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">14:00/16:00</th>
      <td id="22"    <?php fondoHora(14);?> <?php horaOcupada("$fechato[0] 14:00");?> onclick="toinput('<?php echo($fechato[0]);?>14:00', '22')"></td>
      <td id="23"   <?php horaOcupada("$fechato[1] 14:00");?> onclick="toinput('<?php echo($fechato[1]);?>14:00', '23')"></td>
      <td id="24"   <?php horaOcupada("$fechato[2] 14:00");?> onclick="toinput('<?php echo($fechato[2]);?>14:00', '24')"></td>
      <td id="25"   <?php horaOcupada("$fechato[3] 14:00");?> onclick="toinput('<?php echo($fechato[3]);?>14:00', '25')"></td>
      <td id="26"   <?php horaOcupada("$fechato[4] 14:00");?> onclick="toinput('<?php echo($fechato[4]);?>14:00', '26')"></td>
      <td id="27"   <?php horaOcupada("$fechato[5] 14:00");?> onclick="toinput('<?php echo($fechato[5]);?>14:00', '27')"></td>
      <td id="28"   <?php horaOcupada("$fechato[6] 14:00");?> onclick="toinput('<?php echo($fechato[6]);?>14:00', '28')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">16:00/18:00</th>
      <td id="29"   <?php fondoHora(16);?> <?php horaOcupada("$fechato[0] 16:00");?> onclick="toinput('<?php echo($fechato[0]);?>16:00', '29')"></td>
      <td id="30"  <?php horaOcupada("$fechato[1] 16:00");?> onclick="toinput('<?php echo($fechato[1]);?>16:00', '30')"></td>
      <td id="31"  <?php horaOcupada("$fechato[2] 16:00");?> onclick="toinput('<?php echo($fechato[2]);?>16:00', '31')"></td>
      <td id="32"  <?php horaOcupada("$fechato[3] 16:00");?> onclick="toinput('<?php echo($fechato[3]);?>16:00', '32')"></td>
      <td id="33"  <?php horaOcupada("$fechato[4] 16:00");?> onclick="toinput('<?php echo($fechato[4]);?>16:00', '33')"></td>
      <td id="34"  <?php horaOcupada("$fechato[5] 16:00");?> onclick="toinput('<?php echo($fechato[5]);?>16:00', '34')"></td>
      <td id="35"  <?php horaOcupada("$fechato[6] 16:00");?> onclick="toinput('<?php echo($fechato[6]);?>16:00', '35')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">18:00/20:00</th>
      <td id="36"  <?php fondoHora(18);?> <?php horaOcupada("$fechato[0] 18:00");?> onclick="toinput('<?php echo($fechato[0]);?>18:00', '36')"></td>
      <td id="37"  <?php horaOcupada("$fechato[1] 18:00");?> onclick="toinput('<?php echo($fechato[1]);?>18:00', '37')"></td>
      <td id="38"  <?php horaOcupada("$fechato[2] 18:00");?> onclick="toinput('<?php echo($fechato[2]);?>18:00', '38')"></td>
      <td id="39"  <?php horaOcupada("$fechato[3] 18:00");?> onclick="toinput('<?php echo($fechato[3]);?>18:00', '39')"></td>
      <td id="40"  <?php horaOcupada("$fechato[4] 18:00");?> onclick="toinput('<?php echo($fechato[4]);?>18:00', '40')"></td>
      <td id="41"  <?php horaOcupada("$fechato[5] 18:00");?> onclick="toinput('<?php echo($fechato[5]);?>18:00', '41')"></td>
      <td id="42"  <?php horaOcupada("$fechato[6] 18:00");?> onclick="toinput('<?php echo($fechato[6]);?>18:00', '42')"></td>
    </tr>
    <tr>
      <th scope="row" class="bg-dark text-light ">20:00/22:00</th>
      <td id="43"   <?php fondoHora(20);?> <?php horaOcupada("$fechato[0] 20:00");?> onclick="toinput('<?php echo($fechato[0]);?>20:00', '43')"></td>
      <td id="44"  <?php horaOcupada("$fechato[1] 20:00");?> onclick="toinput('<?php echo($fechato[1]);?>20:00', '44')"></td>
      <td id="45"  <?php horaOcupada("$fechato[2] 20:00");?> onclick="toinput('<?php echo($fechato[2]);?>20:00', '45')"></td>
      <td id="46"  <?php horaOcupada("$fechato[3] 20:00");?> onclick="toinput('<?php echo($fechato[3]);?>20:00', '46')"></td>
      <td id="47"  <?php horaOcupada("$fechato[4] 20:00");?> onclick="toinput('<?php echo($fechato[4]);?>20:00', '47')"></td>
      <td id="48"  <?php horaOcupada("$fechato[5] 20:00");?> onclick="toinput('<?php echo($fechato[5]);?>20:00', '48')"></td>
      <td id="49"  <?php horaOcupada("$fechato[6] 20:00");?> onclick="toinput('<?php echo($fechato[6]);?>20:00', '49')"></td>
    </tr>
  </tbody>
</table>

<form  action="index.php?controller=clase&amp;action=add" method="POST" class="text-center">


      <div class="form-group">
          <input type="number" class="form-control" name="maxAlum" placeholder="<?=i18n("Maximo de Alumnos")?>">
      </div>
      <div class="form-group">
          <input type="text" class="form-control" name="descripcion" placeholder="<?=i18n("Descripcion")?>">
      </div>


      </div>

      <input  type="text" name="fecha" id="input" >
       <input type="submit" value="Crear Clase" class="btn btn-yagami mx-auto" style="width: 200px;"></input>

</form >

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

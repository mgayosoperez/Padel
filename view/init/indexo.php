<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img class="mr-2" src="icon/padel.png" height="50" width="50" >Padelo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  </div>
  <form class="form-inline">
   	<div class="mr-5 text-light"></div>
    <a href="index.php?controller=deportista&amp;action=login"><img src="icon/out.png" height="27" width="27"></a>
  </form>
</nav>


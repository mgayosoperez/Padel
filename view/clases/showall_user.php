
<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$listaClasesGrupales = $view->getVariable("clasesGrupales");
$listaClasesParticulares = $view->getVariable("clasesParticulares");
$listaMisClasesGrupales = $view->getVariable("misclasesGrupales");
$listaMisClasesParticulares = $view->getVariable("misClasesParticulares");
$errors = $view->getVariable("errors");
?>

<h1>Clases Grupales</h1>

  <table class="table" border=1>

          <tr>
              <!-- Títulos de la -->
              <th>
                  IdClase
              </th>
              <th>
                  Maximo de Alumnos
              </th>
              <th>
                  Descripcion
              </th>
              <th>
                  Fecha
              </th>
              <th>
                  Entrenador
              </th>

          </tr>
        <?php foreach ($listaClasesGrupales as $clase){?>
          <tr>
              <td><?= $clase->getIdClase()?></td>
              <td><?= $clase->getMaxAlum()?></td>
              <td><?= $clase->getDescripcion()?></td>
              <td><?= $clase->getFecha()?></td>
              <td><?= $clase->getLogin()?></td>

              <td>
                <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
              </td>

          </tr>
        <?php } ?>
      </table>

      <h1>Mis clases Grupales</h1>
      <table class="table" border=1>

              <tr>
                  <!-- Títulos de la -->
                  <th>
                      IdClase
                  </th>
                  <th>
                      Maximo de Alumnos
                  </th>
                  <th>
                      Descripcion
                  </th>
                  <th>
                      Fecha
                  </th>
                  <th>
                      Entrenador
                  </th>

              </tr>
            <?php foreach ($listaMisClasesGrupales as $miclase){?>
              <tr>
                  <td><?= $miclase->getIdClase()?></td>
                  <td><?= $miclase->getMaxAlum()?></td>
                  <td><?= $miclase->getDescripcion()?></td>
                  <td><?= $miclase->getFecha()?></td>
                  <td><?= $miclase->getLogin()?></td>

                  <td>
                    <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $miclase->getIdClase()?>">Desinscribirse</a> </button>
                  </td>

              </tr>
            <?php } ?>
          </table>

      <h1>Clases Particulares</h1>

        <table class="table" border=1>

                <tr>
                    <!-- Títulos de la -->
                    <th>
                        IdClase
                    </th>
                    <th>
                        Fecha
                    </th>
                    <th>
                        Entrenador
                    </th>

                </tr>
              <?php foreach ($listaClasesParticulares as $clase){?>
                <tr>
                    <td><?= $clase->getIdClase()?></td>
                    <td><?= $clase->getFecha()?></td>
                    <td><?= $clase->getLogin()?></td>
                    <td>
                      <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=inscribirse&amp;idClase=<?= $clase->getIdClase()?>">Inscribirse</a> </button>
                    </td>

                </tr>
              <?php } ?>
            </table>

            <h1>Mis clases Particulares</h1>
            <table class="table" border=1>

                    <tr>
                        <!-- Títulos de la -->
                        <th>
                            IdClase
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Entrenador
                        </th>

                    </tr>
                  <?php foreach ($listaMisClasesParticulares as $miclase){?>
                    <tr>
                        <td><?= $miclase->getIdClase()?></td>
                        <td><?= $miclase->getFecha()?></td>
                        <td><?= $miclase->getLogin()?></td>
                        <td>
                          <button type="button" class="btn"> <a href="index.php?controller=clase&amp;action=desinscribirse&amp;idClase=<?= $clase->getIdClase()?>">Desinscribirse</a> </button>
                        </td>

                    </tr>
                  <?php } ?>
                </table>

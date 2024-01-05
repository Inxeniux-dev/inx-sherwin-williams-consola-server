<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>User Console Edit</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-12">
                               <h5 class ="text-primary">Editar Usuario</h5>
                            </div>
                        </div>
                    </div>


                      <div class="invoi invoi-blue">
                          <div class="row">
                                  <div class="col-md-6 col-12">
                                      <div class="table-responsive  mt-3">
                                              <table class="table  table-sm">
                                                  <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">Usuario :</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $data["user"]->username; ?></b></td>
                                                    </tr>
                                                  </tbody>
                                              </table>

                                      </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                      <div class="table-responsive  mt-3">
                                              <table class="table  table-sm">
                                                  <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">Nombre :</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $data["user"]->nombre; ?></b></td>
                                                    </tr>
                                                  </tbody>
                                              </table>
                                      </div>
                                  </div>

                          </div>
                      </div>

                      <div class="invoi">
                          <div class="row">
                            <div class="col-md-12">
                                    <?php
                                        $permisos = to_object($data["schema"]);
                                        $permisos_login = json_decode($data["user"]->permisos);

                                        $count = 0;
                                        foreach ($permisos as $modulo => $permiso) {
                                          $count++;
                                          echo '  <ul class="list-group my-4">';
                                            echo '<li class="list-group-item active"><h5>'.strtoupper($count.".-".str_replace("_", " ", $modulo)).'</h5></li>';

                                            foreach ($permiso as $submodulo => $permiso_submodulo) {
                                                echo '<li class="list-group-item list-group-item-success font-italic"><b>'.strtoupper(str_replace("_", " ", $submodulo)).'</b></li>';

                                                if(count($permiso_submodulo) > 0)
                                                {
                                                    foreach ($permiso_submodulo as $submodulo2 => $estatus) {

                                                        $estado = $permisos_login->$modulo->$submodulo->$submodulo2;
                                                        $check = $estado == 1 ? 'checked' : '';

                                                        echo '<li class="list-group-item">
                                                              <div class="form-check">
                                                                  <input class="form-check-input hand check-per" type="checkbox" value="'.$modulo.'-'.$submodulo.'-'.$submodulo2.'" id="'.$submodulo.$submodulo2.'" '.$check.'>
                                                                  <label class="form-check-label hand" for="'.$submodulo.$submodulo2.'">
                                                                    '.str_replace("_", " ", $submodulo2).'
                                                                  </label>
                                                              </div>';

                                                              //echo $modulo."->".$submodulo."->".$submodulo2;

                                                        echo '</li>';
                                                    }
                                                }
                                            }

                                            echo '</ul>';
                                        }
                                    ?>

                              </div>
                        </div>
                    </div>

                          <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


      <input type="hidden" value = "<?php echo $data["user"]->iduser; ?>" id = "iduser" />


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/user/console.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

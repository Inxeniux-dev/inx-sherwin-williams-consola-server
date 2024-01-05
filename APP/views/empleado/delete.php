<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Eliminar Empleado</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi invoi-blue">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Eliminar Empleado</h5>
                            </div>
                        </div>
                    </div>


                    <?php
                          $empleado = $data["empleado"]->fetch_object();
                    ?>


                  <div class="invoi">
                              <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del empleado </h5>
                                      </div>

                                      <input type="hidden" id = "idemploye" value = "<?php echo $empleado->idempleado; ?>" />

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">

                                      <div class = "alert alert-warning">
                                                <b>¿Desea eliminar el empleado?</b> No es posible revertir
                                        </div>

                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $empleado->nombre." ".$empleado->apellido; ?>' readonly id = "codigo">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Número de Empleado</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $empleado->no_empleado; ?>' readonly>
                                              </div>
                                          </div>

                                          <button class = "btn btn-danger float-right btn-delete my-5" style="width:250px;"><i class="fas fa-check-circle"></i> Eliminar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/empleado/delete.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

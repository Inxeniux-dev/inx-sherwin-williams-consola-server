<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Listado de Rotación del Empleado</title>
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
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Rotación de Personal</h5>
                            </div>
                        </div>
                    </div>

                    <?php
                        $empleado = $data["empleado"]->fetch_object();
                    ?>

                    <div class="invoi invoi-blue">
                          <div class="row">
                                  <div class="col-md-6 col-12">
                                      <div class="table-responsive  mt-3">
                                              <table class="table  table-sm">
                                                  <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">Nombre :</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $empleado->nombre." ".$empleado->apellido; ?></b></td>
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
                                                        <td class="text-blanco spacing">Sucursal Base :</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $empleado->idsucursal."-".$empleado->sucursal_nombre;?></b></td>
                                                    </tr>
                                                  </tbody>
                                              </table>
                                      </div>
                                  </div>

                          </div>
                      </div>


                    <div class="invoi">
                                <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                             <h5><i class="fas fa-info-circle"></i> Asignar a Sucursal </h5>
                                        </div>

                                          <input type="hidden" id = "idemploye" value = "<?php echo $data["id"]; ?>" />

                                        <div class="col-md-3 col-sm-12 col-12 "></div>
                                        <div class="col-md-6 col-sm-12 col-12 ">

                                            <div class="form-group row">
                                                <label for="all" class="col-sm-4 col-form-label col-form-label-sm hand"><b>Asignar a Todas las Sucursales</b></label>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input hand" type="checkbox" value="" id="all">
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group row">
                                                <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Sucursal</label>
                                                <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" id="sucursal">
                                                      <option value = "-1">Seleccione</option>
                                                      <option value = "0">00-Matriz</option>
                                                      <?php
                                                          while($row = $data["stores"]->fetch_object())
                                                          {
                                                              echo '<option value = "'.$row->idsucursal.'">'.addCeros($row->idsucursal).'-'.$row->nombre.'</option>';
                                                          }
                                                      ?>
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="unexpired" class="col-sm-4 col-form-label col-form-label-sm hand"><b>Sin Expiración</b></label>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input hand" type="checkbox" value="" id="unexpired">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fechfin" class="col-sm-4 col-form-label col-form-label-sm">Expiración</label>
                                                <div class="col-sm-8">
                                                <input type="date" class="form-control form-control-sm" id="expiracion" min = "<?php echo date('Y-m-d');?>" value = '<?php echo date("Y-m-d");?>'>
                                                </div>
                                            </div>
                                            <button class = "btn my-btn-blue float-right btn-save" style="width:250px;"><i class="fas fa-check-circle"></i> Agregar</button>
                                        </div>

                                </div>

                    </div>


                        <div class="invoi">
                          <div class="table-responsive table-rotacion" style='min-height: 50px;'>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/empleado/rotation.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Días Inhábiles</title>
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
                          <div class="col-sm-12">
                               <h5 class ="text-blanco"><b>Días Inhábiles para Puntos de Venta</b></h5>
                            </div>
                        </div>
                    </div>

                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-12">
                                Esta opción sirve para poder desbloquear el corte de tiendas cuando haya un día inhábil, por ejemplo: <b>día del trabajo, navidad, año nuevo</b>.
                            </div>
                        </div>
                    </div>


                    <div class="invoi">
                                <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                             <h5><i class="fas fa-info-circle"></i> Seleccione la fecha inhábil </h5>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-12 "></div>
                                        <div class="col-md-6 col-sm-12 col-12 ">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-4 col-form-label col-form-label-sm">Fecha</label>
                                                <div class="col-sm-8">
                                                <input type="date" class="form-control form-control-sm" id="date" min = "<?php echo date('Y-m-d');?>" value = '<?php echo date("Y-m-d");?>'>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="concepto" class="col-sm-4 col-form-label col-form-label-sm">Motivo</label>
                                                <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" id="concepto" placeholder="Ingrese una descripción">
                                                </div>
                                            </div>
                                            <button class = "btn my-btn-blue float-right" style="width:250px;" onclick = "addDate();"><i class="fas fa-check-circle"></i> Agregar</button>
                                        </div>

                                </div>

                    </div>


                        <div class="invoi">
                          <div class="table-responsive table-days" style='min-height: 200px;'>
                                <table class = "table table-hover table-striped">
                                    <thead>
                                        <tr>
                                           <th>Fecha Inhábil</th>
                                           <th style = "text-align:right;">Motivo</th>
                                           <th style = "text-align:right;">Usuario</th>
                                           <th style = "text-align:right;">Fecha de registro</th>
                                           <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                          while($row = $data->fetch_object())
                                          {
                                              echo '<tr>
                                                  <td><b>'.fechaCortaAbreviada($row->dia_inhabil).'</b></td>
                                                  <td align = "right">'.$row->concepto.'</td>
                                                  <td align = "right">'.$row->user.'</td>
                                                  <td align = "right">'.fechaCortaAbreviadaConHora($row->create_at).'</td>
                                                  <td align = "center">
                                                      <div class="dropdown">
                                                          <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              <i class="fa fa-ellipsis-h"></i>
                                                          </button>
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick = "deleteDate('.$row->id.');"><i class="fas fa-trash"></i> Eliminar</a>
                                                          </div>
                                                      </div>
                                                  </td>
                                                </tr>
                                              </tr>';
                                          }

                                      ?>

                                    </tbody>
                                </table>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/settings/not_working.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Listado de Facturas</title>
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
                               <h5 class ="text-primary">Listado de ficheros de respaldos la sucursal </h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a href="../create/" class = 'dropdown-item'><i class="fas fa-exchange-alt"></i> Nueva Venta</a>
                                                <a class="dropdown-item text-default r-xls" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-excel"></i> Exportar a Excel
                                                </a>
                                                <a class="dropdown-item text-default r-pdf" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>
                                        </div>
                                </div>
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
                                                          <td class="text-blanco spacing">Test :</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b></td>
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
                                                          <td class="text-blanco spacing">Test :</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>


                        <div class="invoi">
                          <div class="table-responsive table-prices" style='min-height: 50px;'>
                            <table class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>Fichero</th>
                                          <th>Fecha de Corte</th>
                                          <th>Fecha de Modificación</th>
                                          <th style="text-align:center;"></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                          foreach ($data as $key => $value) {

                                              $file = $value;

                                              $fecha = $file["corte"];
                                              $icon = '<i class="fas fa-download" title = "descargar"></i>';

                                              $opciones = '<div class="dropdown">
                                                              <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                  <i class="fa fa-ellipsis-h"></i>
                                                              </button>
                                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                                <a class="dropdown-item" href = "javascript:void(0);" onclick = "upload_backup(\''.$file["file"].'\');"><i class="fas fa-arrow-circle-up"></i> Restaurar Respaldo </a>
                                                              </div>
                                                          </div>';


                                              if($file["file_error"] > 0)
                                              {
                                                  $fecha = '<i class="fas fa-exclamation-triangle"></i> No cumple con la estructura del archivo de respaldo';
                                                  $icon = '<i class="far fa-trash-alt" title = "eliminar"></i>';
                                                  $opciones = '';
                                              }

                                              echo '<tr>
                                                        <td align = "center">'.$icon.'</td>
                                                        <td>'.$file["file"].'</td>
                                                        <td>'.$fecha.'</td>
                                                        <td>'.$file["date"].'</td>
                                                        <td align = "center">'.$opciones.'</td>
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
    <script src ="<?php echo PATH; ?>js/backup/list.js"></script>
</body>
</html>

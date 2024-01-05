<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Detalle</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">

                    <?php $transfer = $data["transfer"]; ?>
                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Detalle de transferencia</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
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
                                                          <td class="text-blanco spacing">Sucursal:</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $transfer->idsucursal."-".$transfer->nombre; ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Importe:</td>
                                                          <td class="text-blanco spacing" align = "right"><b>$<?php echo number_format($transfer->importe, 2)?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Cuenta:</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>

                                        </div>
                                    </div>

                                    <?php 
                                            $fecha_confirmacion = ($transfer->fecha_confirmacion == null || $transfer->fecha_confirmacion == "0000-00-00 00:00:00") ? 'No confirmado' : fechaCortaAbreviadaConHora($transfer->fecha_confirmacion);

                                            $fecha_confirmacion_store = ($transfer->fecha_confirmacion_store == null || $transfer->fecha_confirmacion_store == "0000-00-00 00:00:00") ? 'No confirmado' : fechaCortaAbreviadaConHora($transfer->fecha_confirmacion_store);

                                    ?>
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha Solicitud:</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b><?php echo fechaCortaAbreviadaConHora($transfer->fecha_transferencia); ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha Confirmación Contabilidad:</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b><?php echo $fecha_confirmacion; ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha Confirmación Encargado:</td>
                                                          <td class="text-blanco spacing" align = "right"><b></b><?php echo $fecha_confirmacion_store; ?></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>


                        <div class="invoi">
                          <div class="row">
                            <div class="col-12">
                                    <b>Comentario Encargado: </b><br>
                                    <?php echo $transfer->comentario; ?>
                            </div>
                          </div>
                       </div>

                       <div class="invoi">
                          <div class="row">
                            <div class="col-12">
                                    <b>Comentario Contabilidad:</b><br>
                                    <?php echo $transfer->comentario_cont; ?>
                            </div>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

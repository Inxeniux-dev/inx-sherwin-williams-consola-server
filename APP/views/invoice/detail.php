<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Detalle Factura</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">

                      <?php
                          $factura = $data["invoice"];
                          $proveedor = $data["proveedor"];
                      ?>

                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Detalle de la Factura <b><?php echo $factura->serie."-".$factura->factura; ?> </b></h5>
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

                                        <input type="hidden" id = "idf" value = "<?php echo $factura->idcompra; ?>" />
                                        <input type="hidden" id = "doc" value = "<?php echo $factura->folio; ?>" />
                                        <input type="hidden" id = "factura" value = "<?php echo $factura->factura; ?>" />
                                        <input type="hidden" id = "idalmacen" value = "<?php echo $factura->idalmacen; ?>" />

                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Proveedor :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $proveedor->razon_social; ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Documento :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo number_format($factura->folio, 0); ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Factura :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $factura->serie."-".$factura->factura; ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Total Factura :</td>
                                                          <td class="text-blanco spacing" align = "right"><b>$<?php echo number_format($factura->total_costo, 2); ?></b></td>
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
                                                          <td class="text-blanco spacing">Fecha de Factura :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo fechaCortaAbreviada($factura->fecha_factura); ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha de Captura en Almacén:</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo fechaCortaAbreviada($factura->fecha_corte); ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha de Pago :</td>
                                                          <td class="text-blanco spacing" align = "right">
                                                            <b>
                                                              <?php
                                                                  echo strlen($factura->fecha_pago) > 0 ? fechaCortaAbreviada($factura->fecha_pago) : 'NO PAGADO';
                                                              ?>
                                                           </b>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>


                        <div class="invoi">
                          <div class="table-responsive table-codes" style='min-height: 50px;'>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/invoice/detail.js"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <script src ="<?php echo PATH; ?>../public/js/app/sweetalert2.min.js"></script>

    <title>Item Detail</title>
  </head>
  <body>
  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php" ?>


              <div class="container-fluid ">
                    <div class="row">

                        <div class="invoi" style ="margin-bottom: 1px;">

                            <div class="row">
                                <div class="col-sm-6 col-12 ">
                                        <i class="fa fa-home"></i> Detalle e Historial de movimientos de  <span class="text-primary"><b><?php
                                        if($data == null)
                                        {
                                            echo "<span class = 'text-danger'> El código ingresado no existe. </span>";
                                        }
                                        else
                                        {
                                            echo strtoupper($data->descripcion);
                                        }
                                        ?></b></span>
                                </div>
                                <?php
                                if($data != null)
                                     { ?>
                                    <div class="col-sm-6 col-12" style="text-align: right;">

                                          <div class="dropdown">
                                              <button class="btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa fa-cog"></i> Reporte
                                              </button>

                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                  <a class="dropdown-item text-default" href="add/">
                                                  <i class="far fa-file-excel"></i> Exportar a Excel
                                                  </a>

                                                  <a class="dropdown-item text-default r-pdf" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                  </a>
                                              </div>
                                          </div> <!-- end dropdown -->

                                    </div>

                                <?php } ?>
                            </div>
                        </div> <!-- end invoi-->


                  <?php   if($data != null) {
                           $SISTEMA_CON_KARDEX = $_SESSION["config"]["use_kardex"];
                           $existencia = $data->existencia;
                           if(!$SISTEMA_CON_KARDEX)
                           {
                              $existencia = "N/A";
                           }

                           $status_campania = "<span class = 'text'><i class='fas fa-toggle-off'></i> FINALIZADA</span>";
                           $descuento = number_format(0,2);

                  $fecha_actual = strtotime($_SESSION["config"]["date_corte"].date("H:i:s"));
                  $fecha_inicial = strtotime($data->fecha_inicial);
                  $fecha_final = strtotime($data->fecha_final);

                  if($fecha_actual > $fecha_inicial && $fecha_actual < $fecha_final)
                	{
                	  $status_campania = "<span class = 'text'><i class='fas fa-toggle-on'></i> ACTIVA</span>";
                    $descuento = number_format($data->descuento,2);
                  }




                     ?>



                    <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                        <div class="row">
                                  <div class="col-md-6 col-12">

                                     <i class="fas fa-barcode"></i> <b class="spacing">Detalles de producto</b>
                                     <button class="btn btn-sm  float-right my-btn-blue-border search-remision">Buscar Producto</button><br>

                                      <div class="table-responsive  mt-3">
                                              <table class="table  table-sm">
                                                  <tbody>
                                                    <tr>
                                                        <input type="hidden" id= "code" value = "<?php echo $data->codigo; ?>"/>
                                                        <td class="text-blanco spacing">C&oacute;digo :</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $data->codigo; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-blanco spacing">Existencia:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo number_format($data->existencia, 0); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-blanco spacing">Precio:</td>
                                                        <td class="text-blanco spacing" align = "right"><b>$<?php echo number_format($data->precio,2); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-blanco spacing">Clave SAT:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $data->clave_sat; ?></b></td>
                                                    </tr>

                                                </tbody>
                                              </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">

                                      <i class="fas fa-percent"></i> <b class="spacing">Detalles de campaña</b>

                                      <div class="table-responsive  mt-3">
                                              <table class="table  table-sm">
                                                  <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">C&oacute;digo de Barras:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $data->codigo_barras; ?></b></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-blanco spacing">Campaña de descuento:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $status_campania; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-blanco spacing">Descuento por campaña:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo $descuento; ?> %</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-blanco spacing">Fecha de campaña de descuento:</td>
                                                        <td class="text-blanco spacing" align = "right"><b><?php echo fechaCortaAbreviada($data->fecha_inicial)." al ".fechaCortaAbreviada($data->fecha_final); ?></b></td>
                                                    </tr>
                                                </tbody>
                                              </table>
                                        </div>
                                      </div>
                              </div>
                      </div>


              <?php  } ?>


                    <?php  if($data->kardex_visible == true){  ?>

                        <div class="invoi" style ="margin-bottom: 1px;">
                                <div class="form-row">
                                        <div class="col">
                                            <input type = "date" name = "dateInitial" id="dateInitial" class="form-control form-control-sm" value = "<?php echo $data->fechini; ?>"/>
                                        </div>
                                        <div class="col">
                                            <input type = "date" name = "dateFinaly" id = "dateFinaly" class="form-control form-control-sm" value = "<?php echo $data->fechfin; ?>"/>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                </div>   <!-- end form-row-->
                        </div> <!-- end invoi-->


                        <div class="invoi" style ="margin-bottom: 1px;">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="table-responsive table-items-kardex" style='min-height: 200px;'>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end invoi-->


                    <?php } ?>


                     </div> <!-- end row-->

                </div> <!-- end container fluid-->

            </div>

        </div>


    </div>

    <?php if($data->kardex_visible == true){ echo "<script>var kv = true; </script>"; } else { echo "<script>var kv = false; </script>"; } ?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/details.js"></script>


    <script>
        $(document).ready(function(){

        });

    </script>


</body>
</html>

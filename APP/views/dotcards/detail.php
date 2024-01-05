<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Dotcard Detail</title>
  </head>
  <body>
  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php

            $changes = $data["changes"];
            $data = $data["data"];

        ?>
              <div class="container-fluid ">
                    <div class="row">

                        <div class="invoi" style ="margin-bottom: 1px;">

                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                <i class="fas fa-credit-card"></i> Detalles de pintor  <span class="text-primary"><b><?php  echo strtoupper($data->nombre); ?></b></span>
                                </div>
                            </div>
                        </div> <!-- end invoi-->

                        <div class="invoi invoi-blue" style ="margin-bottom: 1px;">

                            <div class="row">

                              <div class="col-sm-6 col-12 ">
                                   <div class="table-responsive  mt-3">
                                          <table class="table  table-sm">
                                              <tbody>
                                              <tr>
                                                  <td class="text-blanco spacing">Tarjeta :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->num_tarjeta; ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Descuento :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->descuento; ?>%</td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Dirección :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->direccion; ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Fecha de Registro :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->fecha_alta; ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>


                              <div class="col-sm-6 col-12 ">
                                   <div class="table-responsive  mt-3">
                                          <table class="table  table-sm">
                                              <tbody>
                                              <tr>
                                                  <td class="text-blanco spacing">Ocupación :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->ocupacion; ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Puntos :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo number_format($data->puntos, 2); ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Email :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->email; ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">Teléfono :</td>
                                                  <td class="text-blanco spacing" align = "right"><?php echo $data->telefono; ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>

                            </div> <!-- end row-->

                        </div> <!-- end invoi-->




                      <div class="invoi" style ="margin-bottom: 1px;">

                          <div class="row">
                              <div class="col-sm-12 col-12 my-4">
                                <h5>Listado de canjes</h5>
                                <div class="table-responsive  mt-3">
                                        <table class="table  table-sm">
                                              <thead>
                                                  <tr>
                                                      <th>Fecha</th>
                                                      <th style="text-align:right">Importe</th>
                                                      <th  style="text-align:right">Puntos</th>
                                                  </tr>
                                              </thead>
                                            <tbody>
                                              <?php
                                              //fecha, importe, tarjeta_puntos_canje.puntos, nombre, num_tarjeta
                                                  while($row = $changes->fetch_object())
                                                  {
                                                    echo '<tr>
                                                            <td>'.fechaCortaAbreviadaConHora($row->fecha).'</td>
                                                            <td align = "right">$ '.number_format($row->importe,2).'</td>
                                                            <td align = "right">'.number_format($row->puntos,0).'</td>
                                                        <tr>';
                                                  }
                                              ?>
                                            </tbody>
                                        </table>
                                </div>
                              </div>
                          </div>
                      </div> <!-- end invoi-->




                        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                     </div> <!-- end row-->

                </div> <!-- end container fluid-->

            </div>

        </div>


    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script>
        $(document).ready(function(){

        });

    </script>


</body>
</html>

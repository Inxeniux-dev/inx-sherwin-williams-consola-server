<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Cambio de precios</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php
            $detail = $data["detail"];
            $data = to_object($data["change"]);

        ?>
              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Detalle del Cambio de Precio #<?php echo $data->id; ?> </h5>
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
                                                  <td class="text-blanco spacing">Fecha de operación :</td>
                                                  <td class="text-blanco spacing" align = "right"><b><?php echo $data->created_at; ?></b></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-blanco spacing">No Prods :</td>
                                                  <td class="text-blanco spacing" align = "right"><b><?php echo number_format($data->no_prod, 0); ?></b></td>
                                              </tr>
                                          </table>
                                  </div>
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="table-responsive  mt-3">
                                          <table class="table  table-sm">
                                              <tbody>
                                              <tr>
                                                  <td class="text-blanco spacing">Responsable :</td>
                                                  <td class="text-blanco spacing" align = "right"><b><?php echo $data->nombre; ?></b></td>
                                              </tr>
                                          </table>
                                  </div>
                              </div>
                          </div>
                        </div>


                        <div class="invoi">
                          <div class="table-responsive table-prices" style='min-height: 50px;'>
                              <table class = "table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th style = "text-align:right;">% Descuento</th>
                                                    <th style = "text-align:right;">Vencimiento</th>
                                                    <th style = "text-align:right;">Precio Anterior</th>
                                                    <th style = "text-align:right;">Precio Nuevo</th>
                                                    <th style = "text-align:right;">Diferencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total = 0;
                                                      while($row = $detail->fetch_object())
                                                      {  

                                                        $data = json_decode($row->data);
                                                        
                                                        $label_descuento = strtotime($data->fechfin) < strtotime(date("Y-m-d")) ? "<span class = 'badge badge-danger'>Vencido</span>" : "";

                                                          echo "<tr>
                                                                  <td><b>".$row->codigo."</b><br>".strtoupper($row->descripcion)."</td>
                                                                  <td align = 'right'>".$data->descuento."%</td>
                                                                  <td align = 'right'>".fechaCortaAbreviadaConHora($data->fechfin)."<br> ".$label_descuento."</td>
                                                                  <td align = 'right'>$".number_format($row->precio_anterior,2)."</td>
                                                                  <td align = 'right'>$".number_format($row->precio_nuevo,2)."</td>
                                                                  <td align = 'right'>$".number_format(($row->precio_nuevo - $row->precio_anterior),2)."</td>
                                                            </tr>";

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

<script>
    $(document).ready(function(){
      $("#sidebarCollapse").on('click', function(){
          $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
      });
    });
</script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Cambio de Puntos</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php
            $id = $data["id"];
            $prods = $data["prods"];
            $data = $data["data"];
        ?>

              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Detalle del canje #<?php echo $id; ?></h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                         <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
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

                                      <div class="col-sm-6 col-12 ">
                                           <div class="table-responsive  mt-3">
                                                  <table class="table  table-sm">
                                                      <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Fecha Canje :</td>
                                                          <td class="text-blanco spacing" align = "right"><?php echo $data->fecha; ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Puntos Utilizados:</td>
                                                          <td class="text-blanco spacing" align = "right"><?php echo $data->puntos; ?></td>
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
                                                          <td class="text-blanco spacing">Pintor :</td>
                                                          <td class="text-blanco spacing" align = "right"><?php echo $data->nombre; ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Tarjeta:</td>
                                                          <td class="text-blanco spacing" align = "right"><?php echo $data->num_tarjeta; ?></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>

                            </div>
                        </div>


                        <div class="invoi">
                                <div class="row">
                                    <div class="col-sm-12 col-12 ">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Precio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                          while($row = $prods->fetch_object())
                                                          {
                                                              echo '<tr>
                                                                      <td>'.$row->producto.'</td>
                                                                      <td align = "right">$ '.number_format($row->precio,2).'</td>
                                                                  <tr>';
                                                          }
                                                        ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list.js">

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>

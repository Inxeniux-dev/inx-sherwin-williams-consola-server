<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>PDV Location</title>
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
                               <h5 class ="text-primary">Estatus de Punto de Venta en Sucursales</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                              
                            </div>
                        </div>
                    </div>




                    <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                     <div class="form-row">
                                            <div class="col-2">
                                                    <label for="exampleInputEmail1">Fecha final</label>
                                                    <input type="date" class="form-control form-control-sm" id="dateFinaly" name="dateFinaly"  value = "<?php echo $_SESSION["config"]["date_corte"]; ?>"/>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Seleccione Sucursal</label>
                                                        <select class="form-control form-control-sm" id="location" name="location">
                                                              <option value = "0">Todas</option>
                                                              <?php
                                                                  while($row = $data->fetch_object())
                                                                  {
                                                                      echo "<option value = '".$row->idsucursal."'>".$row->idsucursal."-".$row->nombre."</option>";
                                                                  }
                                                               ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                        <label for="exampleInputEmail1"></label>
                                                        <button class="btn my-btn-blanco btn-sm btn-block btn-search" style ="margin-top:10px;"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="invoi">
                          <div class="table-responsive table-location" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/reports/location_status.js"></script>
</body>
</html>

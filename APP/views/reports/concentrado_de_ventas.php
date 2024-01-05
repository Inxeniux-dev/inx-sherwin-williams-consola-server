<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Sales Concentrate</title>
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
                          <div class="col-sm-12">
                               <h5 class ="text-primary">Concentrado de Ventas</h5>
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
                            <div class="table-concentrado" style='min-height: 100px;'>
                                  <!-- <table class = "table-responsive table table-hover table-condensed table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Sucursal</th>
                                                    <th>Ventas de Contado</th>
                                                    <th>Dev S/V Contado</th>
                                                    <th>Venta Neta Contado</th>
                                                    <th>Cobranza</th>
                                                    <th>Cont + Cobr</th>
                                                    <th>Obj Ventas</th>
                                                    <th>% Alcanzado</th>
                                                    <th>Ventas de Crédito</th>
                                                    <th>Dev S/V Crédito</th>
                                                    <th>Venta Neta Crédito</th>
                                                    <th>Saldo CxC</th>
                                                    <th>Stock</th>
                                                    <th>Desc. Cont</th>
                                                    <th>Desc. Créd</th>
                                                    <th>Desc. Not Créd</th>
                                                    <th>Cargos</th>
                                                    <th>Cancela Contado</th>
                                                    <th>Cancela Crédito</th>
                                                    <th>Saldo Ini Mes</th>
                                                    <th>Ventas Stock</th>
                                                    <th>Entradas</th>
                                                    <th>Salidas</th>
                                                    <th>Ajuste Precios Acum</th>
                                                    <th>Saldo Día Ant</th>
                                                    <th>Ventas Stock Día Corte</th>
                                                    <th>Entradas Día Corte</th>
                                                    <th>Salidas Día Corte</th>
                                                    <th>Ajuste Precios</th>
                                                    <th>Saldo Actual</th>
                                                    <th>Desc Dev Cont</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                    </table> -->
                            </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/reports/concentrado_ventas.js"></script>
</script>
</body>
</html>

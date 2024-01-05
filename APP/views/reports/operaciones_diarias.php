<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Operation Days</title>
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
                               <h5 class ="text-primary">Número de Operaciones Promedio Díarias</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                         <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a class="dropdown-item text-default r-xls" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-excel r-xls"></i> Exportar a Excel
                                                </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                     <div class="form-row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Seleccione Mes</label>
                                                        <select class="form-control form-control-sm" id="month" name="month">
                                                            <?php
                                                                $mes_actual = date("m");
                                                                foreach (getMonths() as $key => $value) {

                                                                    if(($key+1) == $mes_actual)
                                                                    {
                                                                      echo "<option value = '".($key+1)."' selected>".$value."</option>";
                                                                    }
                                                                    else {
                                                                      echo "<option value = '".($key+1)."'>".$value."</option>";
                                                                    }

                                                                }
                                                            ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Seleccione Año</label>
                                                        <select class="form-control form-control-sm" id="year" name="year">
                                                            <?php
                                                            $anio_actual = date("Y");
                                                            foreach (getYears() as $key => $value)
                                                            {
                                                                if($anio_actual == ($value))
                                                                {
                                                                    echo "<option value = '".$value."' selected>".$value."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value = '".$value."'>".$value."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                </div>
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
                          <div class="table-responsive table-sales" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/reports/operation_days.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

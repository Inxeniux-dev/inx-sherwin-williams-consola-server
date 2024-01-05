<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Bitácora Asistencia</title>

    <style>

      .tableFixHead { overflow: auto; height: 100px; }
      .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }

       /* Just common table stuff. Really. */
       table  { border-collapse: collapse; width: 100%; }
       th, td { padding: 8px 16px; }
       th     { background: white; }

       th:first-child, td:first-child
       {
           position:sticky;
           left:0px;
           text-align:left !important;
           background: white;
       }

       th:nth-child(2), td:nth-child(2)
       {
           position:sticky;
           left:45px;
            background: white;
       }

        th:nth-child(3), td:nth-child(3)
       {
           position:sticky;
           left:60px;
            background: white;

       }


   </style>

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
                               <h5 class ="text-primary">Bitácora Global</h5>
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
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="invoi invoi-blue">
                      <div class="row">
                          <div class="col-sm-10 col-12 ">
                              <div class="form-row">


                                  <div class="col">
                                      <label for="proveedor">Sucursal</label>
                                      <select class="form-control form-control-sm" id="sucursal">
                                          <option value = "-1">Todas</option>
                                          <option value = "0">00-OFICINA</option>
                                          <?php
                                              while($row = $data->fetch_object())
                                              {
                                                  echo '<option value = "'.$row->idsucursal.'">'.addCeros($row->idsucursal).'-'.$row->nombre.'</option>';
                                              }
                                          ?>
                                      </select>
                                  </div>

                                  <div class="col">
                                    <label for="almacen">Ordenar Por:</label>
                                      <select class="form-control form-control-sm" id="orden">
                                          <option value = "1" select>Número de Empleado</option>
                                          <option value = "2">Nombre de Empleado</option>
                                          <option value = "3" >Apellido de Empleado</option>
                                          <option value = "4" >Número de Sucursal</option>
                                      </select>
                                  </div>


                                  <?php

                                    $mes = date("m");

                                    $enero = '';
                                    $febrero = '';
                                    $marzo = '';
                                    $abril = '';
                                    $mayo = '';
                                    $junio = '';
                                    $julio = '';
                                    $agosto = '';
                                    $septiembre = '';
                                    $octubre = '';
                                    $noviembre = '';
                                    $diciembre = '';

                                    if($mes == "01"){ $enero = 'selected'; }
                                    if($mes == "02"){ $febrero = 'selected'; }
                                    if($mes == "03"){ $marzo = 'selected'; }
                                    if($mes == "04"){ $abril = 'selected'; }
                                    if($mes == "05"){ $mayo = 'selected'; }
                                    if($mes == "06"){ $junio = 'selected'; }
                                    if($mes == "07"){$julio = 'selected'; }
                                    if($mes == "08"){ $agosto = 'selected'; }
                                    if($mes == "09"){ $septiembre = 'selected'; }
                                    if($mes == "10"){ $octubre = 'selected'; }
                                    if($mes == "11"){ $noviembre = 'selected'; }
                                    if($mes == "12"){ $diciembre = 'selected'; }
                              ?>
                                  <div class="col">
                                      <label for="almacen">Fecha</label>
                                      <select class="form-control form-control-sm" id="mes">
                                            <option value = "01" <?php echo $enero; ?>>Enero</option>
                                            <option value = "02" <?php echo $febrero; ?>>Febrero</option>
                                            <option value = "03" <?php echo $marzo; ?>>Marzo</option>
                                            <option value = "04" <?php echo $abril; ?>>Abril</option>
                                            <option value = "05" <?php echo $mayo; ?>>Mayo</option>
                                            <option value = "06" <?php echo $junio; ?>>Junio</option>
                                            <option value = "07" <?php echo $julio; ?>>Julio</option>
                                            <option value = "08" <?php echo $agosto; ?>>Agosto</option>
                                            <option value = "09" <?php echo $septiembre ?>>Septiembre</option>
                                            <option value = "10" <?php echo $octubre; ?>>Octubre</option>
                                            <option value = "11" <?php echo $noviembre; ?>>Noviembre</option>
                                            <option value = "12" <?php echo $diciembre; ?>>Diciembre</option>
                                      </select>
                                  </div>

                                  <div class="col">
                                    <label for="almacen">Año: </label>
                                      <select class="form-control form-control-sm" id="anio">

                                          <?php 

                                              $year = date("Y");
                                              for ($i=2022; $i <= $year; $i++) { 
                                                  if($year == $i)
                                                  {
                                                    echo '<option value = "'.$i.'" selected>'.$i.'</option>';
                                                  }
                                                  else
                                                  {
                                                    echo '<option value = "'.$i.'">'.$i.'</option>';
                                                  }
                                              }
                                          ?>
                                      </select>
                                  </div>

                                  <div class="col">
                                      <button class="btn my-btn-blue-border btn-sm" id="btn-search" style="margin-top:30px; width:100%"><i class="fa fa-search"></i> Buscar</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>

                      <div class = "row">
                    <div class="container" style="margin-left: 0px; margin-right: 0px; max-width: 1500px;"> <!-- QUITAR ESTE PEDO -->
                            <div class="invoi">
                              <div class = "row">
                                  <div class ="col-12">
                                      <div class="table-responsive table-bitacora tableFixHead" style='height: 600px;'>
                                      </div>
                                  </div>
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
    <script src ="<?php echo PATH; ?>js/asistencia/bitacora_global.js"></script>
</body>
</html>

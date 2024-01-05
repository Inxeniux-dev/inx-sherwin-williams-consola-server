<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Bitácora Asistencia</title>
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
                               <h5 class ="text-primary">Bitácora de Asistencia de Supervisores</h5>
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
                                      <label for="sucursal">Sucursal</label>
                                      <select class="form-control form-control-sm" id="sucursal">
                                          <option value = "0">Todas</option>
                                          <?php
                                              while($row = $data->fetch_object())
                                              {
                                                  echo '<option value = "'.$row->idsucursal.'">'.addCeros($row->idsucursal).'-'.$row->nombre.'</option>';
                                              }
                                          ?>
                                      </select>
                                  </div>

                                  <div class="col">
                                    <label for="movimiento">Movimiento</label>
                                      <select class="form-control form-control-sm" id="movimiento">
                                          <option value = "0">Seleccione</option>
                                          <option value = "3" select>Entradas</option>
                                          <option value = "4" >Salidas</option>
                                      </select>
                                  </div>

                                  <div class="col">
                                      <label for="fecha">Fecha Inicial</label>
                                      <input type="date" class="form-control form-control-sm" id="fecha"  value = '<?php echo date("Y-m-d");?>' max = '<?php echo date("Y-m-d"); ?>'/>
                                  </div>

                                  <div class="col">
                                      <label for="fechafin">Fecha Final</label>
                                      <input type="date" class="form-control form-control-sm" id="fechafin"  value = '<?php echo date("Y-m-d");?>' min = '<?php echo date("Y-m-d"); ?>'/>
                                  </div>

                                  <div class="col">
                                    <label for="orden">Ordenar Por</label>
                                      <select class="form-control form-control-sm" id="orden">
                                          <option value = "1">Hora</option>
                                          <option value = "2">Suc nombre</option>
                                          <option value = "3" select>Suc clave</option>
                                          <option value = "4">Empleado nombre</option>
                                      </select>
                                  </div>

                                  <div class="col">
                                      <button class="btn my-btn-blue-border btn-sm" id="btn-search" style="margin-top:30px; width:100%"><i class="fa fa-search"></i> Buscar</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>


                        <div class="invoi">
                          <div class="table-responsive table-bitacora" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/asistencia/bitacora_super.js"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Listado de Empleados</title>
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
                               <h5 class ="text-primary">Listado de Empleados</h5>
                            </div>
                        </div>
                    </div>



                    <div class="invoi invoi-blue">
                      <div class="row">
                          <div class="col-sm-10 col-12 ">
                              <div class="form-row">

                                <div class="col">
                                  <label for="almacen">Nombre o Apellido</label>
                                  <input type = "text" class = "form-control form-control-sm"  placeholder="Ingrese nombre o apellido" id = "search"/>
                                 </div>

                                  <div class="col">
                                      <label for="proveedor">Sucursal</label>
                                      <select class="form-control form-control-sm" id="sucursal">
                                          <option value = "-1">Todas</option>
                                          <option value = "0">00-MATRIZ</option>
                                          <?php
                                              while($row = $data->fetch_object())
                                              {
                                                  echo '<option value = "'.$row->idsucursal.'">'.addCeros($row->idsucursal).'-'.$row->nombre.'</option>';
                                              }
                                          ?>
                                      </select>
                                  </div>

                                  <div class="col">
                                    <label for="almacen">Ordenar Por</label>
                                      <select class="form-control form-control-sm" id="orden">
                                          <option value = "1">Nombre</option>
                                          <option value = "2">Apellido</option>
                                          <option value = "3">Número de Empleado</option>
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
                          <div class="table-responsive table-empleado" style='min-height: 250px;'>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/empleado/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Sucursales</title>
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
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Estatus de Respaldos en Servidor</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn my-btn-blue dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class = 'fa fa-cog'></i> Exportar
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


                    <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                        <div class="row">
                            <div class="col-sm-12 col-12 ">

                                <div class="form-row">
                                      <div class="col">
                                        <label for="tipo">Tipo</label>
                                        <select class="form-control form-control-sm" id="tipo">
                                            <option value = "0" selected> Todos </option>
                                            <option value = "1" > Tienda </option>
                                            <option value = "2"> Almacén </option>
                                            <option value = "3"> Auditoria </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn my-btn-blanco btn-sm" id="btn-search" style = "margin-top: 32px; width:200px;"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="invoi">
                            <div class="table-responsive" style='min-height: 200px;'>
                              <table class="table table-hover table-striped table-stores">
                                  <thead>
                                      <tr>
                                          <th>Sucursal</th>
                                          <th  style="text-align:center;">Fecha de Corte</th>
                                          <th  style="text-align:center;">Versión</th>
                                          <th  style="text-align:center;"> Últ Archivo de Respaldo</th>
                                           <th style="text-align:center;">Path de búsqueda</th>
                                          <th style="text-align:center;">Observación</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                            </div>
                        </div>

                        <div class="invoi">
                              <div class="row">
                                  <div class = "col-md-12">
                                        <button class="btn my-btn-blue float-right d-none btn-all"><i class="fas fa-check-circle"></i> Restaurar los Respaldos Faltantes</button>
                                  </div>
                              </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/settings/stores_list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

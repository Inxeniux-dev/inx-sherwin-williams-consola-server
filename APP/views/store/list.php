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
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Listado de Sucursales</h5>
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

                                <a href="../add/" class="btn my-btn-blue-light btn-sm float-right" style="margin-right:15px;"><i class="fas fa-sitemap"></i> Agregar Sucursal</a>
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
                                            <option value = "" selected> Todos </option>
                                            <option value = "0" > Tienda </option>
                                            <option value = "1"> Almacén </option>
                                            <option value = "3"> Auditoria </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="estado">Estado</label>
                                        <select class="form-control form-control-sm" id="estado">
                                            <option value = "1" selected>Activas</option>
                                            <option value = "0">Inactivas</option>
                                            <option value = ""> Todos </option>
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
                            <div class="table-responsive table-stores" style='min-height: 200px;'>
                            </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/catalog/stores_list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

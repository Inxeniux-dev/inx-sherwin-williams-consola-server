<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items</title>
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
                                <h5 class ="text-primary"><b><i class="fas fa-exclamation-triangle"></i> Listado de productos no aplicados </b></h5>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class = 'dropdown'>
                                        <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                            <i class = 'fa fa-cog'></i> Opciones
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
                                  <div class="col-sm-12 col-12 ">
                                      <div class="form-row">
                                        <div class="col">
                                            <input type="date" class="form-control form-control-sm fechini" id="fechini" value = "<?php echo $_SESSION["config"]["date_corte"]; ?>"/>
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control form-control-sm fechfin" id="fechfin" value = "<?php echo $_SESSION["config"]["date_corte"]; ?>" />
                                        </div>
                                          <div class="col">
                                              <select class="form-control form-control-sm type" id="type">
                                                  <option value = "0">Productos No Aplicados</option>
                                                  <option value = "1">Productos Aplicados</option>
                                                  <option value = "3">Ambos</option>
                                              </select>
                                          </div>
                                          <div class="col">
                                              <button class="btn my-btn-blanco btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                        </div>


                        <div class="invoi">
                            <div class="table-responsive table-items" style='min-height: 200px;'>
                                    
                            </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/notapplied.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

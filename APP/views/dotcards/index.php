<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Tarjeta Puntos</title>
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
                                <div class="col-sm-6">
                                     <h5 class="text-primary"><i class = 'fas fa-bell'></i> Listado de tarjeta de puntos</h5>
                                </div>

                                    <div class="col-sm-6 col-12" style = "text-align: right;">

                                            <div class="dropdown ">
                                                    <button class="btn my-btn-blue btn-sm dropdown-toggle dropdown-toggle-remove-row btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i> Opciones
                                                    </button>
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                            <h6 class="dropdown-header"><b>Tarjeta Puntos</b></h6>

                                                            <a class="dropdown-item text-default btn-sync" href="javascript:void(0);">
                                                              <i class="fas fa-sync-alt"></i> Sincronizar
                                                            </a>

                                                            <div class="dropdown-divider"></div>

                                                            <h6 class="dropdown-header"><b>Reportes</b></h6>

                                                              <a class="dropdown-item text-default" href="#">
                                                              <i class="far fa-file-excel"></i> Exportar a Excel
                                                              </a>

                                                              <a class="dropdown-item text-default r-pdf"  target="_blank" href="javascript:void(0);">
                                                              <i class="far fa-file-pdf"></i> Exportar a PDF
                                                              </a>

                                                    </div>
                                            </div> <!-- end dropdown -->


                                            <a href="changelist/"  class="btn  my-btn-blue-light btn-sm float-right" style="margin-right: 20px;"><i class="fa fa-barcode"></i> Listado de canjes</a>
                                 </div>
                             </div>
                      </div>

                        <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Buscar número de tarjeta o nombre" />
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue-border btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoi" >
                                <div class="table-responsive table-dotcards" style='min-height: 200px;'>
                                </div>
                            </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>
                        </div>
                    </div>
            </div>

        </div>


    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/dotcard/list.js?v=<?php echo(rand()); ?>"></script>

</script>


</body>
</html>

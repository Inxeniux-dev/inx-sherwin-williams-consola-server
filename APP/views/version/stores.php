<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Versiones</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi invoi-blue">
                        <div class="row">
                          <div class="col-sm-12">
                               <h5 class ="text-blanco"><i class="fas fa-code-branch"></i> Listado de Versión de Sucursales</h5>
                            </div>
                        </div>
                    </div>



                        <div class="invoi ">
                            <div class="row">
                                  <div class = "col-12">
                                      <div class = "alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Si la información de la <b>versión</b> no es visible es posible de que <b>no hay conexión de red</b> hacia la tienda <b>(la tienda no tiene internet o hamachi iniciado)</b>.
                                      </div>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class = "col-12">
                                      <div class = "alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Si la sucursal <b>no aparece</b> en el listado, es posible que aún <b>no</b> se ha actualizado la información en el <b>listado de sucursales (verificar)</b>.
                                      </div>
                                  </div>
                            </div>
                        </div>

                        <?php
                            $data_version = $data;
                            $version = 'No Encontrado';
                            $create_at = '';
                            if($data_version)
                            {
                               $data_version = $data_version->fetch_object();
                               $version = $data_version->version;
                               $create_at = $data_version->create_at;
                            }
                        ?>

                        <div class="invoi">
                            <div class="row">
                              <div class="col-sm-8">
                                   <h4>Versión Actual en Producción: <b><?php echo $version; ?></b></h4>
                                   <h6>Fecha de Liberación: <b><?php echo fechaCortaAbreviadaConHora($create_at); ?></b></h6>
                                </div>
                                 <div class="col-sm-4">
                                <div class = 'dropdown'>
                                    <button class = 'btn my-btn-blue dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class = 'fa fa-cog'></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a class="dropdown-item text-default r-pdf" href="../../report/storeVersion/1/" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>
                                        </div>
                                </div>

                            </div>
                            </div>
                        </div>


                        <div class="invoi">
                          <div class="row">
                              <div class="col-sm-12 col-md-12">
                                  <div class="table-responsive table-stores" style='min-height: 50px;'>
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
    <script src ="<?php echo PATH; ?>js/version/store_list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

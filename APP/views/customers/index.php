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
                                <h5 class="text-primary"><i class="fas fa-sitemap"></i> Listado de artículos</h5>
                              </div>
                              <div class="col-sm-4">
                                    <a href="../create/" class="btn my-btn-blue-light btn-sm float-right"><i class="fas fa-shopping-cart"></i> Nuevo Producto</a>
                               </div>
                           </div>
                      </div>

                        <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-10 col-12 ">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Buscar artículos" />
                                        </div>
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="line">
                                                <option value = "0">Todas las lineas</option>
                                                <?php
                                                    while($row = $data->fetch_object())
                                                    {
                                                        echo '<option value = "'.$row->idlinea.'">'.$row->idlinea.' - '.$row->descripcion.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="type">
                                                <option value = "0">Todos</option>
                                                <option value = "1">Con existencias </option>
                                                <option value = "2">Sin existencias </option>
                                                <option value = "3">Con descuento </option>
                                                <option value = "4">Sin descuento </option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <select class="form-control form-control-sm" id="capacity">
                                                <option value = "-1">Seleccione Capacidad</option>
                                                <?php
                                                  $capacidades = to_object($_SESSION["catalog"]["capacity"]);
                                                      foreach ($capacidades as $key => $value) {
                                                          echo "<option value = '".$value->id."'>".$value->capacidad." ".$value->unidad."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue-border btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-12" style = "text-align: right;">

                                    <div class="dropdown">
                                            <button class="btn my-btn-blanco btn-sm dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog"></i> Opciones
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <h6 class="dropdown-header"><b>Artículos</b></h6>

                                                    <a class="dropdown-item text-default r-xls" target="_blank" href="javascript:void(0);">
                                                        <i class="far fa-file-excel"></i> Exportar a Excel
                                                    </a>

                                                    <a class="dropdown-item text-default r-pdf"  target="_blank" href="javascript:void(0);">
                                                        <i class="far fa-file-pdf"></i> Exportar a PDF
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <h6 class="dropdown-header"><b>Precios</b></h6>

                                                    <a class="dropdown-item text-default" href="../prices/change/">
                                                    <i class="fas fa-tags"></i> Cambio de Precios
                                                    </a>


                                                    <div class="dropdown-divider"></div>

                                                    <h6 class="dropdown-header"><b>Red</b></h6>

                                                    <a class="dropdown-item text-default" href="./search/">
                                                      <i class="fas fa-sitemap"></i> Consultar Existencias
                                                    </a>


                                            </div>
                                    </div> <!-- end dropdown -->


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


    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

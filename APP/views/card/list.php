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
                          <div class="col-sm-8">
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Listado de Tarjeta de Puntos</h5>
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
                                                <li><hr class="dropdown-divider"></li>
                                                <a class="dropdown-item text-default" href="javascript:void(0);" target="_blank" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="far fa-file-excel"></i> Exportar Cuentas Activas
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
                                        <label for="search">Nombre o No. de Tarjeta</label>
                                        <input class="form-control form-control-sm" id="search" placeholder="Nombre o No de tarjeta"/>
                                    </div>
                                    <div class="col">
                                        <label for="search">Estatus</label>
                                        <select class="form-control form-control-sm" id = "status">
                                            <option value="-1">Todos</option>
                                            <option value = "1" selected>Activos</option>
                                            <option value="0">Inactivos</option>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exportar Concentrado de Tarjetas Activas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class = "row">
                <div class = "col-12">
                    <div class="form-group">
                        <label for="year">Seleccione año</label>
                        <select class = "form-control form-control-sm" id = "year">
                                <?php 
                                        $anios = getYears(2021);

                                        foreach($anios as $anio)
                                        {
                                            $selected = $anio == date("Y") ? "selected" : "";
                                            echo "<option value = '".$anio."' ".$selected.">".$anio."</option>";
                                        }
                                ?>
                        </select>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick = 'reportMonth()'>Exportar</button>
      </div>
    </div>
  </div>
</div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/card/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

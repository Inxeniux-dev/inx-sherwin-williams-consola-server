<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Historial de Versiones</title>
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
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Historial de Versiones</h5>
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
                                <?php if($data["create"]) {?>
                                  <a href="../create/" class="btn my-btn-blue-only-border btn-sm float-right" style="margin-right: 20px;"><i class="fas fa-folder-plus"></i> Crear Versión</a>
                               <?php } ?>
                            </div>
                        </div>
                    </div>


                    <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                        <div class="row">
                            <div class="col-sm-12 col-12 ">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="fechini">Fecha inicial</label>
                                        <input type="date" class="form-control form-control-sm" id="fechini" value = "<?php echo SumarORestarFechas(date("Y-m-d"), "-", "6", "month"); ?>"/>
                                    </div>
                                    <div class="col">
                                        <label for="fechfin">Fecha final</label>
                                        <input type="date" class="form-control form-control-sm" id="fechfin"  value = "<?php echo date("Y-m-d"); ?>" />
                                    </div>
                                    <div class="col">
                                        <label for="status">Estatus</label>
                                        <select class="form-control form-control-sm" id="status">
                                            <option value = "-1"> Todos </option>
                                            <option value = "0" selected> Producción </option>
                                            <option value = "1"> Desarrollo </option>
                                            <option value = "2"> Pruebas </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="proyecto">Proyecto</label>
                                        <select class="form-control form-control-sm" id="proyecto">
                                            <option value = "0"> Todos </option>
                                            <?php
                                                $proyects = $data["proyects"];
                                                while($row = $proyects->fetch_object())
                                                {
                                                    echo '<option value = "'.$row->id.'">'.$row->nombre.'</option>';
                                                }
                                             ?>

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
                            <div class="table-responsive table-version" style='min-height: 200px;'>
                            </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/version/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

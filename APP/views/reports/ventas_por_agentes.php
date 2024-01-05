<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Sales by Agent</title>
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
                               <h5 class ="text-primary">Historial de Ventas por Agente</h5>
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
                                            <div class="col-2">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Seleccione Agente</label>
                                                    <select class="form-control form-control-sm" id="agente" name="agente">

                                                    </select>
                                            </div>
                                            </div>

                                            <div class="col-2">
                                                    <label for="exampleInputEmail1">Fecha inicial</label>
                                                    <input type="date" class="form-control form-control-sm" id="dateInitial" name="dateInitial" value = "<?php echo $_SESSION["config"]["date_corte"]; ?>"/>
                                            </div>


                                            <div class="col-2">
                                                    <label for="exampleInputEmail1">Fecha final</label>
                                                    <input type="date" class="form-control form-control-sm" id="dateFinaly" name="dateFinaly"  value = "<?php echo $_SESSION["config"]["date_corte"]; ?>"/>
                                            </div>
                                            <div class="col-2">
                                                        <label for="exampleInputEmail1"></label>
                                                        <button class="btn my-btn-blanco btn-sm btn-block btn-search" style ="margin-top:10px;"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="invoi">
                          <div class="table-responsive table-sales" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/reports/sales_by_agent.js"></script>
</body>
</html>

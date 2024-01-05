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
                               <h5 class ="text-primary"><i class="fas fa-user-alt"></i> Historial de Ventas Detalladas por Cliente</h5>
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

                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">Cliente :</td>
                                                        <td class="text-blanco spacing t-client" align = "right"><b>Selecciona un cliente</b></td>
                                                    </tr>
                                                </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-blanco spacing">Buscar :</td>
                                                        <td class="text-blanco spacing" align = "right">
                                                            <button class="btn my-btn-blue-border btn-sm btn-clients" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search"></i> Buscar cliente</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                        </div>
                                    </div>

                                <div class="col-sm-12 col-12 ">

                                    <div class="form-row">
                                        <div class="col-3">
                                            <input type="date" class="form-control form-control-sm" id="dateInitial" name="dateInitial" value = "<?php echo $_SESSION["config"]["date_corte"]; ?>"/>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" class="form-control form-control-sm" id="dateFinaly" name="dateFinaly"  value = "<?php echo $_SESSION["config"]["date_corte"]; ?>" />
                                        </div>
                                        <div class="col-3">
                                            <button class="btn my-btn-blanco btn-sm btn-block" id="btn-search" ><i class="fa fa-search"></i> Buscar</button>
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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Búsqueda de Cliente</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

                <div class="form-row">
                        <div class="col-5">
                            <input type="text" class="form-control form-control-sm" id="searchCustomer" name="searchCustomer" placeholder="Ingrese el nombre, rfc o razón del cliente">
                        </div>
                        <div class="col-2">
                              <select class="form-control form-control-sm" id="typeCustomer">
                                  <option value = "0">Todos</option>
                                  <option value = "1">Con Crédito</option>
                                  <option value = "2">Sin Crédito</option>
                              </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success btn-sm" id="btn-search-customer"><i class="fa fa-search"></i> Buscar</button>
                        </div>

                </div>

                <div class = "table-modal-customers table-responsive">
                    Consultando ...
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div><!-- Modal -->




    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/reports/sales_by_client.js"></script>

</body>
</html>

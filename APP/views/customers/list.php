<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Clientes</title>
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
                              <div class="col-sm-4">
                                <h5 class="text-primary"><i class="fas fa-sitemap"></i> Catálogo General de Clientes</h5>
                              </div>
                              <div class="col-sm-8">

                                <div class="dropdown">
                                        <button class="btn my-btn-blue-light btn-sm dropdown-toggle dropdown-toggle-remove-row btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-file-export"></i> Exportar
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <h6 class="dropdown-header"><b>Clientes</b></h6>

                                                <a class="dropdown-item text-default r-xls" target="_blank" href="javascript:void(0);">
                                                    <i class="far fa-file-excel"></i> Exportar a Excel
                                                </a>

                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item text-default r-pdf" target="_blank" href="javascript:void(0);">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>

                                          <!---      <a class="dropdown-item text-default r-pdf"  target="_blank" href="javascript:void(0);">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a> --->
                                        </div>
                                </div> <!-- end dropdown -->

                                <?php if($data["permisos"]->Crear) { ?>
                                      <a href="../add/" class="btn my-btn-blue-light btn-sm float-right" style="margin-right:15px;"><i class="fas fa-user"></i> Agregar Cliente</a>
                                <?php }
                                      if($data["permisos"]->Editar_Precio) {
                                 ?>
                                      <a href="../listPrices/" class="btn my-btn-blue btn-sm float-right" style="margin-right:15px;"><i class="fas fa-sitemap"></i> Cambiar Precios</a>
                                <?php }
                                    if($data["permisos"]->Editar_Descuento) {
                                 ?>
                                    <a href="../campaing/" class="btn my-btn-blue btn-sm float-right" style="margin-right:15px;"><i class="fas fa-sitemap"></i> Campaña Descuentos</a>
                                <?php } ?>
                               </div>
                           </div>
                      </div>

                        <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="search">Nombre, RFC o Razón:</label>
                                            <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Ingrese Nombre, RFC o Razón" />
                                        </div>
                                        <div class="col">
                                        <label for="searchApellido">Apellido:</label>
                                            <input type="text" class="form-control form-control-sm" id="searchApellido" name="searchApellido" placeholder="Ingrese Apellido" />
                                        </div>
                                        <div class="col">
                                            <label for="type">Filtros:</label>
                                            <select class="form-control form-control-sm" id="type">
                                                <option value="0">Todos</option>
                                                <option value="1">Con crédito </option>
                                                <option value="2">Sin crédito </option>
                                                <option value="3">Con descuento </option>
                                                <option value="4">Con saldo pendiente </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue-border btn-sm" id="btn-search" style = "margin-top:30px;"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="invoi">
                                <div class="table-responsive table-items" style="min-height: 200px;">
                                </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/customers/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

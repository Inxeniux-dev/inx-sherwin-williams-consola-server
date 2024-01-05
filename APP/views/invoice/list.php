<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Libreta de Pagos</title>
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
                               <h5 class ="text-primary">Historial de Facturas de Proveedor</h5>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a class="dropdown-item text-default r-xls" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-excel"></i> Exportar a Excel
                                                </a>
                                        </div>
                                </div>
                                <?php if($data["permisos"]->Crear) { ?>
                                    <button  class="btn my-btn-blue-light btn-sm float-right btn-sync" style="margin-right: 20px;"><i class="fas fa-sync-alt"></i> Sincronizar Información de Almacenes</button>
                              <?php } ?>
                            </div>
                        </div>
                    </div>


                    <div class="invoi invoi-blue">
                        <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-row">

                                      <div class="col-3">
                                          <label for="search">Folio o Documento</label>
                                          <input type="text" class="form-control form-control-sm" id="search" placeholder="Buscar folio o documento" />
                                      </div>

                                        <div class="col-2">
                                          <label for="estatus">Estatus</label>
                                            <select class="form-control form-control-sm" id="estatus">
                                                <option value = "2" selected>Ver Todos</option>
                                                <option value = "0">No Pagados</option>
                                                <option value = "1">Pagados</option>
                                            </select>
                                        </div>

                                        <div class="col-2">
                                          <label for="tipo">Tipo de Producto</label>
                                            <select class="form-control form-control-sm" id="tipo">
                                                <option value = "0" selected>Ver Todos</option>
                                                <option value = "1">Productos Generales</option>
                                                <option value = "2">Publicidad</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                        <div class="invoi invoi-blue">
                          <div class="row">
                              <div class="col-sm-10 col-12 ">
                                  <div class="form-row">


                                      <div class="col-3">
                                          <label for="proveedor">Proveedor</label>
                                          <select class="form-control form-control-sm" id="proveedor">
                                              <option value = "0">Seleccione Proveedor</option>
                                              <?php
                                                  $almacen = $data["proveedor"];
                                                  $count = 0;
                                                  while($row = $almacen->fetch_object())
                                                  {
                                                    $select = $count == 0 ? 'selected' : '';
                                                    $count++;
                                                    echo "<option value = '".$row->idproveedor."'".$select.">".$row->razon_social."</option>";
                                                  }
                                              ?>
                                          </select>
                                      </div>

                                      <div class="col-3">
                                        <label for="almacen">Almacén</label>
                                          <select class="form-control form-control-sm" id="almacen">
                                              <option value = "0">Seleccione Almacén</option>
                                              <?php
                                                  $almacen = $data["almacen"];
                                                  $count_almacen = 0;
                                                  while($row = $almacen->fetch_object())
                                                  {
                                                    $select = $count == 0 ? 'selected' : '';
                                                    $count_almacen++;
                                                    echo "<option value = '".$row->idalmacen."' ".$select.">".$row->clave."-".$row->nombre."</option>";
                                                  }
                                              ?>
                                          </select>
                                      </div>

                                      <div class="col">
                                          <label for="almacen">Fecha Inicial</label>
                                          <input type="date" class="form-control form-control-sm" id="fechini" value = '<?php echo SumaroRestarFechas(date("Y-m-d"), "-", 2, "week");?>' max = '<?php echo date("Y-m-d"); ?>' />
                                      </div>

                                      <div class="col">
                                          <label for="almacen">Fecha Final</label>
                                          <input type="date" class="form-control form-control-sm" id="fechfin"  value = '<?php echo date("Y-m-d");?>' max = '<?php echo date("Y-m-d"); ?>'/>
                                      </div>

                                      <div class="col">
                                          <button class="btn my-btn-blue-border btn-sm" id="btn-search" style="margin-top:30px; width:100%"><i class="fa fa-search"></i> Buscar</button>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </div>

                        <?php if($count_almacen == 0) { ?>
                            <div class="invoi">
                              <div class="row">
                                  <div class = "col-12">
                                      <div class = "alert alert-warning"><h5><b>No tienes almacenes asignados a tu usuario.</b><small> Solicitalo con el administrador</small></h5></div>
                                  </div>
                              </div>
                           </div>
                      <?php  } ?>

                        <div class="invoi">
                          <div class="table-responsive table-invoice" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>



<div class="modal fade" id="modalDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Fecha de Pago</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class = "row">
            <div class = "col-md-6 d-doc"></div>
            <div class = "col-md-6 d-factura"></div>
            <div class = "col-md-12"><hr></div>
        </div>
        <div class = "row my-3">
            <div class = "col-md-12">
                <div class="form-group">
                    <label for="fecha"><b>Seleccione Fecha</b></label>
                    <input type="date" class="form-control" id="fecha" value = "<?php echo date("Y-m-d");?>" min = "<?php echo SumaroRestarFechas(date("Y-m-d"), '-', 40, 'day');?>" max = "<?php echo date("Y-m-d");?>">
                      <small id="fechaHelp" class="form-text text-muted" style="font-size:13px;">Una vez confirmado, no podrá modificar los cambios</small>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-lefth" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn my-btn-blue btn-save"><i class="fas fa-check-circle"></i> Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/invoice/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

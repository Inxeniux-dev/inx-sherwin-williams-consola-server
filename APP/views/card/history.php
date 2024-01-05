<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Bitácora</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php
        		if($data["card"])
        		{
        			$card = $data["card"]->fetch_object();
        		}

            $permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Tarjeta_Puntos;
         ?>

              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-6">
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Bitácora de Puntos</h5>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn my-btn-blue dropdown-toggle dropdown-toggle-remove-row float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
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

                                <?php if($permisos->Editar) { ?>
                                <button type="button" class="btn my-btn-blue-only-border float-right" data-toggle="modal" data-target="#exampleModalCenter" style="margin-right:15px; margin-left: 15px;"><i class="fas fa-exchange-alt"></i> Agregar Movimiento </button>
                              <?php  } ?>
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
                                                          <td class="text-blanco spacing">Nombre :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $card->nombre." ".$card->apellido; ?></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Tarjeta :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $card->no_tarjeta;?></b></td>
                                                      </tr>
                                                        <tr>
                                                          <td class="text-blanco spacing">Puntos Actuales :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo number_format($card->puntos,0);?></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>


                    <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                        <div class="row">
                            <div class="col-sm-12 col-12 ">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="tipo">Tipo</label>
                                        <select class="form-control form-control-sm" id="tipo">
                                            <option value = "0" selected> Todos </option>
                                            <option value = "1" > Acumulado </option>
                                            <option value = "2"> Canjes </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="suc">Sucursal</label>
                                        <select class="form-control form-control-sm" id="suc">
                                            <option value = "0" selected> Todas </option>
                                        </select>
                                    </div>
                                    <div class=" col-sm-2 col-md-1">
                                        <label for="rows">Registros</label>
                                        <select class="form-control form-control-sm" id="rows">
                                            <option value = "50"> 50 </option>
                                            <option value = "100"> 100 </option>
                                            <option value = "200"> 200 </option>
                                            <option value = "500"> 500 </option>
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
                            <div class="table-responsive table-bitacora" style='min-height: 250px;'>
                            </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>




        <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Nuevo Movimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class ="row">
            <div class="col-md-12 col-sm-12 col-12 ">

                  <div class = "alert alert-info mb-4">
                      Este proceso se <b>registrará</b> en una <b>bítacora</b> con tus datos de <b>usuario</b>.
                  </div>

                  <input type = "hidden" id = "idcard" value = "<?php echo $card->idtarjeta;?>">

                  <div class="form-group row mt-2">
                      <label for="nombre" class="col-sm-4 col-form-label col-form-label-sm">Nombre de quien registra:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nombre"  placeholder="Ingrese nombre" value = "<?php echo $_SESSION["datauser"]["name"]; ?>" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="tipo_mov" class="col-sm-4 col-form-label col-form-label-sm">Tipo:</label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" id="tipo_mov">
                            <option value = "0">Seleccione</option>
                            <option value = "1">Acumular</option>
                            <option value = "2">Descontar</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="puntos" class="col-sm-4 col-form-label col-form-label-sm">Puntos:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="puntos"  placeholder="Ingrese puntos">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="concepto" class="col-sm-4 col-form-label col-form-label-sm">Concepto:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="concepto"  placeholder="Ingrese Concepto">
                      </div>
                  </div>

            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button class="btn my-btn-blue float-right" onclick="addMov();" style="width:250px;"><i class="fas fa-check-circle"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>


     <?php echo "<script>let id = ".$card->idtarjeta.";</script>"; ?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"; ?>
    <script src ="<?php echo PATH; ?>js/card/bitacora.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

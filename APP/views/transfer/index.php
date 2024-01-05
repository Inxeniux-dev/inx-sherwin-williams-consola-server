<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Transferencias Bancarias</title>
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
                          <div class="col-sm-8">
                               <h5 class ="text-blanco">Historial de Transferencias</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn my-btn-blanco dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                        <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a class="dropdown-item text-default r-xls" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-excel"></i> Exportar a Excel
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
                                          <div class="form-group">
                                             <label for="importe">Importe</label>
                                                 <input type="text" class="form-control form-control-sm" id="importe" placeholder ="Ingrese importe"/>
                                          </div>
                                        </div>
                                        <div class="col">
                                          <div class="form-group">
                                             <label for="fechini">Fecha Inicial</label>
                                                 <input type="date" class="form-control form-control-sm" id="fechini" value = "<?php echo SumarORestarFechas(date("Y-m-d"), "-", "15", "days", false); ?>" max = "<?php  date("Y-m-d"); ?>"/>
                                          </div>
                                        </div>
                                        <div class="col">
                                          <div class="form-group">
                                             <label for="fechfin">Fecha Final</label>
                                                <input type="date" class="form-control form-control-sm" id="fechfin" value = "<?php echo date("Y-m-d"); ?>" max = "<?php echo date("Y-m-d"); ?>" />
                                            </div>
                                        </div>
                                         <div class="col">
                                          <div class="form-group">
                                             <label for="sucursal">Sucursal</label>
                                                <select type="text" class="form-control form-control-sm" id="sucursal">
                                                        <option value = "0">-Todas-</option>  
                                                        <?php 
                                                            $stores = $data["stores"];
                                                            while($row = $stores->fetch_object())
                                                            {
                                                                echo "<option value = ".$row->idsucursal.">".$row->idsucursal."-".$row->nombre."</option>";
                                                            } 
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                          <div class="form-group">
                                             <label for="cuenta">Cuenta Bancaria</label>
                                                <select type="text" class="form-control form-control-sm" id="cuenta">
                                                        <option value = "0">-Todas-</option>  
                                                        <?php 
                                                        $cuentas = $data["cuentas"];
                                                        while($row = $cuentas->fetch_object())
                                                        {
                                                            echo "<option value = ".$row->idcuenta.">".$row->idcuenta."-CTA ".$row->cuenta." ".$row->banco."</option>";
                                                        }
                                                    ?>     
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                          <div class="form-group">
                                             <label for="status">Estatus</label>
                                                <select type="text" class="form-control form-control-sm" id="status">4
                                                        <option value = "-1">-Todos-</option>  
                                                        <option value = "0">Finalizado</option>  
                                                        <option value = "1">Confirmado por Contabilidad</option>
                                                        <option value = "2">Cancelada</option>
                                                        <option value = "3">Pendiente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blanco btn-sm" onclick = "search();" style="margin-top:30px;"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="invoi">
                           <label><b>Las transferencias "no confirmadas" serán visibles en todo momendo</b></label>
                          <div class="table-responsive table-transfer" style='min-height: 50px;'>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>



<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class = "row">
                <div class = "col-md-12">
                    <input type = "text" id = "comment" placeholder="Ingresar comentario" class = "form-control form-control-sm">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel_comment();">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="confirm_comment();">Guardar comentario</button>
      </div>
    </div>
  </div>
</div>



    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/banktransfer/list.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

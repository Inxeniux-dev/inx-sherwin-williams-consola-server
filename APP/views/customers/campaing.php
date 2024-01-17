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
                          <div class="col-sm-6">
                              <h5 class="text-primary"><i class="fas fa-sitemap"></i>Campaña Descuentos</h5>
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
                                                <a class="dropdown-item text-default r-pdf" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>
                                        </div>
                                </div>
                                
                                <a href = "../reinforcementCampaign/" class = "btn btn-primary btn-sm"><i class = "fas fa-sitemap"></i> Campaña de Reforzamiento</a>
                                <button class = "btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-file"><i class = "far fa-file-excel"></i> Cargar</button>
                            </div>
                        </div>
                    </div>
                    
                    
                        <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="line">Código o Descripción</label>
                                            <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Buscar artículos" />
                                        </div>
                                        <div class="col">
                                            <label for="line">Seleccione Linea</label>
                                            <select class="form-control form-control-sm" id="line">
                                                <option value = "0">Seleccione Linea</option>
                                                <?php
                                                    $lineas = $data["lineas"];
                                                    while ($row = $lineas->fetch_object()) {
                                                      echo "<option value = '".$row->idlinea."'>".$row->idlinea."-".$row->descripcion."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                          <label for="line">Capacidad</label>
                                            <select class="form-control form-control-sm" id="capacity">
                                                <option value = "0">Seleccione Capacidad</option>
                                                <?php
                                                    $capacidad = $data["capacidad"];
                                                    while ($row = $capacidad->fetch_object()) {
                                                      echo "<option value = '".$row->idcapacidad."'>".$row->capacidad." ".$row->unidad."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue-border btn-sm" id="btn-search"  style = "margin-top:30px;"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="invoi">
                                <div class="row">
                                    <div class="col-12">
                                        <div class = "alert alert-info"><i class="fas fa-lightbulb"></i> Pulse <b>ENTER</b> para guardar los cambios en cada producto</div>
                                    </div>
                                </div>
                                <div class="table-responsive table-items">
                                </div>
                        </div>

                        <div class="invoi">
                                <div class="row">
                                    <div class ="col-12">
                                          <button class="btn my-btn-blue float-right btn-xml" style="width:350px;"> <i class="fas fa-file-code"></i> Generar documento de precios</button>
                                    </div>
                                </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    </div>



<div class="modal fade" id="modal-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cargar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class = "row">
                <div class="col-sm-12">
                             <form method="post" action="#" enctype="multipart/form-data">
                                 <div class="card">
                                     <div class="card-body">
                                         <h5 class="card-title">Sube el archivo en formato Excel</h5>
                                         <div class="form-group">
                                             <label for="image">Cargar archivo</label>
                                             <input type="file" class="form-control-file" name="image" id="image">
                                         </div>
                                         <br><br>
                                          <input type="button" class="btn my-btn-blue upload" value="Finaliza Carga de Archivo" style="width:250px;">
                                     </div>
                                 </div>
                              </form>
                           </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/campaing.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

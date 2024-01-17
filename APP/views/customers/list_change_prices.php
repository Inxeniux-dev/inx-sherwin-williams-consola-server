<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items List</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php
            $config = $data["config"];
        ?>
              <div class="container-fluid ">
                    <div class="row">

                      <div class="invoi">
                          <div class="row">
                              <div class="col-sm-8">
                                <h5 class="text-primary"><i class="fas fa-sitemap"></i> Cambio de Precios</h5>
                              </div>
                                <?php if($data["permisos"]->Crear) { ?>
                                  <div class="col-sm-4">
                                        <a href="../add/" class="btn my-btn-blue-light btn-sm float-right"><i class="fas fa-sitemap"></i> Agregar Producto</a>
                                   </div>
                                 <?php } ?>

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
                                            <label for="line">Linea</label>
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
                              <div class="col-sm-12 col-12 ">
                                  <div class="form-row">
                                      <div class="col-2">
                                          <label for="line"><b>Factor</b> *Para precio especial</label>
                                          <input type="number" class="form-control form-control-sm" id="factor" placeholder="Ingrese Factor"
                                          value="<?php echo $factor = $config ? $config->factor_precio : ''; ?>"
                                           />
                                      </div>
                                      <div class="col">
                                          <button class="btn my-btn-blue-border btn-sm" id="upd-factor"  style = "margin-top:30px;"><i class="fas fa-pencil-alt"></i> Actualizar</button>
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


                        <div class="invoi">
                                <div class="row">
                                    <div class ="col-12">
                                          <h5>Generar documento para nueva sucursal</h5>
                                          <br>
                                          <button class="btn btn-warning float-left" onclick = "generateAll();"  style="width:350px;"> <i class="fas fa-file-code"></i> Generar</button>
                                    </div>
                                </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list_change_prices.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

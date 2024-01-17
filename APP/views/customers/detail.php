<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Detalle Producto</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Detalle del producto</h5>
                            </div>
                        </div>
                    </div>


                    <?php
                        $item = $data["item"]->fetch_object();
                    ?>


                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del artículo </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Código</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->codigo; ?>' id="codigo" placeholder="Ingrese codigo" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Codigo de Barras</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->barcode; ?>' id="barcode" name="barcode" placeholder="Ingrese barcode" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Descripción</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm"value='<?php echo $item->descripcion; ?>' id="descripcion" name="descripcion" placeholder="Ingrese descripcion" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Precio</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm" value='<?php echo $item->precio; ?>' id="precio" name="precio" placeholder="Ingrese precio" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="clave_sat" class="col-sm-4 col-form-label col-form-label-sm">Clave SAT</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->clave_sat; ?>' id="clave_sat" name="clave_sat" placeholder="Ingrese clave sat" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="peso" class="col-sm-4 col-form-label col-form-label-sm">Peso</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm"value='<?php echo $item->peso; ?>' id="peso" name="peso" placeholder="Ingrese peso" readonly>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <label for="es_base" class="col-sm-4 col-form-label col-form-label-sm"><b>¿Es base para igualado?</b></label>
                                              <div class="col-sm-8">
                                                  <input type="text" class="form-control form-control-sm"value='<?php echo $item->es_base == 1 ? "SI":"NO"; ?>' readonly>
                                              </div>
                                          </div>

                                          <br><hr>

                                          <div class="form-group row">
                                              <label for="line" class="col-sm-4 col-form-label col-form-label-sm">Seleccione Linea</label>
                                              <div class="col-sm-8">
                                                <select class="form-control form-control-sm" id="line" readonly>
                                                    <?php
                                                        $lineas = $data["lineas"];
                                                        while ($row = $lineas->fetch_object()) {

                                                          if($row->idlinea == $item->idlinea)
                                                          {
                                                              echo "<option value = '".$row->idlinea."' selected>".$row->idlinea."-".$row->descripcion."</option>";
                                                          }
                                                        }
                                                    ?>
                                                </select>
                                              </div>
                                          </div>



                                          <div class="form-group row">
                                              <label for="capacity" class="col-sm-4 col-form-label col-form-label-sm">Seleccione Capacidad</label>
                                              <div class="col-sm-8">
                                                <select class="form-control form-control-sm" id="capacity" readonly>
                                                    <?php
                                                        $capacidad = $data["capacidad"];
                                                        while ($row = $capacidad->fetch_object()) {

                                                            if($row->idcapacidad == $item->idcapacidad)
                                                            {
                                                                  echo "<option value = '".$row->idcapacidad."' selected>".$row->capacidad." ".$row->unidad."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                              </div>
                                          </div>

                                          <br><hr>


                                          <div class="form-group row">
                                              <label for="descuento" class="col-sm-4 col-form-label col-form-label-sm">Descuento</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm" value='<?php echo $item->descuento; ?>' id="descuento" name="descuento" placeholder="Ingrese descuento" readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="fechini" class="col-sm-4 col-form-label col-form-label-sm">Fecha inicial</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="fechini" name="fechini" value = '<?php echo fechaCortaAbreviada($item->fechini); ?>' readonly>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <label for="fechfin" class="col-sm-4 col-form-label col-form-label-sm">Fecha final</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="fechfin" name="fechfin" value = '<?php echo fechaCortaAbreviada($item->fechfin); ?>' readonly>
                                              </div>
                                          </div>

                                          <br><hr>

                                          <div class="form-group row">
                                              <label for="status" class="col-sm-4 col-form-label col-form-label-sm"><b>Producto Activo </b></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"value='<?php echo $item->status == 1 ? "ACTIVO":"INACTIVO"; ?>' readonly>
                                                </div>
                                          </div>

                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script>
    $(document).ready(() =>{
        $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass("active");
              $(".content").toggleClass("active");
        });
      });
    </script>
</body>
</html>

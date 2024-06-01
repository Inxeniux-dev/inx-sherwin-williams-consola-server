<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Producto</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Crear producto</h5>
                            </div>
                        </div>
                    </div>




                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del producto </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Código</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="codigo" name="codigo" placeholder="Ingrese codigo">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Código de Barras</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="barcode" name="barcode" placeholder="Ingrese barcode">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="codigo_asociado" class="col-sm-4 col-form-label col-form-label-sm">Código Asociado</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="codigo_asociado" name="codigo_asociado" placeholder="Ingrese código asociado">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Descripción</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="descripcion" name="descripcion" placeholder="Ingrese descripción">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Precio</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm" value='' id="precio" name="precio" placeholder="Ingrese precio">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="clave_sat" class="col-sm-4 col-form-label col-form-label-sm">Clave SAT</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="clave_sat" name="clave_sat" placeholder="Ingrese clave sat">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="peso" class="col-sm-4 col-form-label col-form-label-sm">Peso</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm" value='' id="peso" name="peso" placeholder="Ingrese peso">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="marca" class="col-sm-4 col-form-label col-form-label-sm">Marca</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="marca" name="marca">
                                                      <option value = "0"> Seleccione Marca</option>
                                                      <?php
                                                          $marcas = $data["marcas"];
                                                          while ($row = $marcas->fetch_object()) {
                                                            echo "<option value = '".$row->idmarca."'>".$row->marca."</option>";
                                                          }
                                                      ?>
                                                  </select>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <label for="es_base" class="col-sm-4 col-form-label col-form-label-sm"><b>¿Es base para igualado?</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="es_base">
                                                  </div>
                                              </div>
                                          </div>

                                          <br><hr>

                                          <div class="form-group row">
                                              <label for="line" class="col-sm-4 col-form-label col-form-label-sm">Seleccione Linea</label>
                                              <div class="col-sm-8">
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
                                          </div>



                                          <div class="form-group row">
                                              <label for="capacity" class="col-sm-4 col-form-label col-form-label-sm">Seleccione Capacidad</label>
                                              <div class="col-sm-8">
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
                                          </div>

                                          <br><hr>

                                          <div class="form-group row">
                                              <!--<label for="descuento" class="col-sm-4 col-form-label col-form-label-sm">Descuento</label>-->
                                              <div class="col-sm-8">
                                              <input type="hidden" class="form-control form-control-sm" value='' id="descuento" name="descuento" placeholder="Ingrese descuento">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <!--<label for="fechini" class="col-sm-4 col-form-label col-form-label-sm">Fecha inicial</label>-->
                                              <div class="col-sm-8">
                                              <input type="hidden" class="form-control form-control-sm" id="fechini" name="fechini" value = '<?php echo date("Y-m-d");?>'>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <!--<label for="fechfin" class="col-sm-4 col-form-label col-form-label-sm">Fecha final</label>-->
                                              <div class="col-sm-8">
                                              <input type="hidden" class="form-control form-control-sm" id="fechfin" name="fechfin" value = '<?php echo date("Y-m-d");?>'>
                                              </div>
                                          </div>

                                          <br><hr>
                                          <div class="form-group row">
                                              <div class="col-sm-12">
                                                  <div class="alert alert-info">
                                                      <i class="fas fa-lightbulb"></i> <b>El precio especial</b> se creará <b>automáticamente</b> dependiendo del <b>factor</b> configurado.
                                                  </div>
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right btn-save my-5" style="width:250px;"><i class="fas fa-check-circle"></i> Agregar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

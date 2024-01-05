<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Editar Producto</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Editar Artículo</h5>
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

                                      <input type = "hidden" value = '<?php echo $item->codigo; ?>' id = "cod-hidd"/>
                                      <input type = "hidden" value = '<?php echo $item->barcode; ?>' id = "bar-hidd"/>
                                      <input type = "hidden" value = '<?php echo $item->id; ?>' id = "idprod"/>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Código</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->codigo; ?>' id="codigo" name="codigo" placeholder="Ingrese codigo">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Codigo de Barras</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->barcode; ?>' id="barcode" name="barcode" placeholder="Ingrese barcode">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="codigo_asociado" class="col-sm-4 col-form-label col-form-label-sm">Codigo Asociado</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->codigo_asociado; ?>' id="codigo_asociado" name="codigo_asociado" placeholder="Ingrese código asociado">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Descripción</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm"value='<?php echo $item->descripcion; ?>' id="descripcion" name="descripcion" placeholder="Ingrese descripción">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Precio</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm" value='<?php echo $item->precio; ?>' id="precio" name="precio" placeholder="Ingrese precio">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="clave_sat" class="col-sm-4 col-form-label col-form-label-sm">Clave SAT</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->clave_sat; ?>' id="clave_sat" name="clave_sat" placeholder="Ingrese clave sat">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="peso" class="col-sm-4 col-form-label col-form-label-sm">Peso</label>
                                              <div class="col-sm-8">
                                              <input type="number" class="form-control form-control-sm"value='<?php echo $item->peso; ?>' id="peso" name="peso" placeholder="Ingrese peso">
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
                                                            if($row->idmarca == $item->idmarca)
                                                            {
                                                                echo "<option value = '".$row->idmarca."' selected>".$row->marca."</option>";
                                                            }
                                                            else {
                                                                echo "<option value = '".$row->idmarca."'>".$row->marca."</option>";
                                                            }
                                                          }
                                                      ?>
                                                  </select>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <label for="es_base" class="col-sm-4 col-form-label col-form-label-sm"><b>¿Es base para igualado?</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                    <?php
                                                        $check = $item->es_base == 1 ? "checked":"";
                                                    ?>
                                                      <input class="form-check-input" type="checkbox" value="" id="es_base" <?php echo $check; ?>>
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

                                                          if($row->idlinea == $item->idlinea)
                                                          {
                                                              echo "<option value = '".$row->idlinea."' selected>".$row->idlinea."-".$row->descripcion."</option>";
                                                          }
                                                          else {
                                                              echo "<option value = '".$row->idlinea."'>".$row->idlinea."-".$row->descripcion."</option>";
                                                          }
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

                                                            if($row->idcapacidad == $item->idcapacidad)
                                                            {
                                                                  echo "<option value = '".$row->idcapacidad."' selected>".$row->capacidad." ".$row->unidad."</option>";
                                                            }
                                                            else {
                                                                  echo "<option value = '".$row->idcapacidad."'>".$row->capacidad." ".$row->unidad."</option>";
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
                                              <input type="number" class="form-control form-control-sm" value='<?php echo $item->descuento; ?>' id="descuento" name="descuento" placeholder="Ingrese descuento">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="fechini" class="col-sm-4 col-form-label col-form-label-sm">Fecha inicial</label>
                                              <div class="col-sm-8">
                                              <input type="date" class="form-control form-control-sm" id="fechini" name="fechini" value = '<?php echo $item->fechini; ?>'>
                                              </div>
                                          </div>


                                          <div class="form-group row">
                                              <label for="fechfin" class="col-sm-4 col-form-label col-form-label-sm">Fecha final</label>
                                              <div class="col-sm-8">
                                              <input type="date" class="form-control form-control-sm" id="fechfin" name="fechfin" value = '<?php echo $item->fechfin; ?>'>
                                              </div>
                                          </div>

                                          <br><hr>

                                          <div class="form-group row">
                                              <label for="status" class="col-sm-4 col-form-label col-form-label-sm"><b>Producto Activo </b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input hand" type="checkbox" value="" id="status" <?php echo $item->status == 1 ? "checked" : ""; ?>>
                                                  </div>
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right btn-update my-5" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/edit.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

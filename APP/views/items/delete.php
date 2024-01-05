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
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Eliminar Artículo</h5>
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

                                      <input type = "hidden" value = '<?php echo $item->id; ?>' id = "idprod"/>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">

                                      <div class = "alert alert-warning">
                                                <b>¿Desea eliminar el artículo?</b> No es posible revertir
                                        </div>

                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Código</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->codigo; ?>' readonly id = "codigo">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Codigo de Barras</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->barcode; ?>' readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Descripción</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm"value='<?php echo $item->descripcion; ?>'readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Precio</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo "$".number_format($item->precio,2); ?>' readonly>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="clave_sat" class="col-sm-4 col-form-label col-form-label-sm">Clave SAT</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->clave_sat; ?>'readonly>
                                              </div>
                                          </div>


                                          <button class = "btn btn-danger float-right btn-delete my-5" style="width:250px;"><i class="fas fa-check-circle"></i> Eliminar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/delete.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

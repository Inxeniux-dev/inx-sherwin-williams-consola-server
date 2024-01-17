<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Editrar Producto Canje</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-gift"></i> Editar producto para canje de puntos</h5>
                            </div>
                        </div>
                    </div>


                    <?php
                        $item = $data["item"]->fetch_object();
                    ?>


                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del producto </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <input type = "hidden" id ="id" value="<?php echo $item->idproducto; ?>"/>

                                          <div class="form-group row">
                                              <label for="producto" class="col-sm-4 col-form-label col-form-label-sm">Producto</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" style = "font-weight:bold;" value='<?php echo $item->producto; ?>' id="producto" name="producto" placeholder="Ingrese producto">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="cantidad" class="col-sm-4 col-form-label col-form-label-sm">Cantidad</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->cantidad; ?>' id="cantidad" name="cantidad" placeholder="Ingrese producto">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Precio</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $item->precio; ?>' id="precio" name="precio" placeholder="Ingrese precio">
                                              </div>
                                          </div>


                                          <button class = "btn my-btn-blue float-right btn-update" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/create.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

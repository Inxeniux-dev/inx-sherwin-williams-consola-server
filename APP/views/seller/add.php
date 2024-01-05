<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Vendedor</title>
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
                               <h5 class ="text-blanco">Ingresar datos del vendedor</h5>
                            </div>
                        </div>
                    </div>



                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del vendedor </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">

                                          <div class="form-group row">
                                              <label for="rfc" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="nombre" name="nombre" placeholder="Ingrese Nombre">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="razon" class="col-sm-4 col-form-label col-form-label-sm">Objetivo</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="objetivo" name="objetivo" placeholder="Ingrese objetivo">
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right" onclick="addSeller();" style="width:250px;"><i class="fas fa-check-circle"></i> Agregar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/seller/add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

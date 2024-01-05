<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Linea</title>
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
                               <h5 class ="text-blanco">Ingresar datos de la linea</h5>
                            </div>
                        </div>
                    </div>



                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos de la linea </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">

                                          <div class="form-group row">
                                              <label for="key" class="col-sm-4 col-form-label col-form-label-sm">Clave</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="key" name="key" placeholder="Ingrese Clave">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="linea" class="col-sm-4 col-form-label col-form-label-sm">Nombre de la línea</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="linea" name="linea" placeholder="Ingrese línea">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="tipo" class="col-sm-4 col-form-label col-form-label-sm">Tipo</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="tipo" name="tipo">
                                                      <option value = "0"> Seleccione Tipo</option>
                                                      <option value = "1"> Pintura</option>
                                                      <option value = "2"> Complemento</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="igualado" class="col-sm-4 col-form-label col-form-label-sm">¿Para Igualado?</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="igualado" name="igualado">
                                                      <option value = "0">No</option>
                                                      <option value = "1">Si</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="conversion" class="col-sm-4 col-form-label col-form-label-sm">¿Para Conversión?</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="conversion" name="conversion">
                                                      <option value = "0">No</option>
                                                      <option value = "1">Si</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right" onclick="addLine();" style="width:250px;"><i class="fas fa-check-circle"></i> Agregar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/line/add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

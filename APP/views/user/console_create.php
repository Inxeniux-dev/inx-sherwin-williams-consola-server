<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Usuario</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-user"></i> Crear Usuario</h5>
                            </div>
                        </div>
                    </div>




                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del usuario </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                                              <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" value='' id="nombre" placeholder="Ingrese nombre completo">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="barcode" class="col-sm-4 col-form-label col-form-label-sm">Nombre de Usuario</label>
                                              <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" value='' id="username"  placeholder="Ingrese nombre de usuario">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Password</label>
                                              <div class="col-sm-8">
                                                <input type="password" class="form-control form-control-sm" value='' id="password" placeholder="Ingrese assword">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Repetir Password</label>
                                              <div class="col-sm-8">
                                                <input type="password" class="form-control form-control-sm" value='' id="repeat_password" placeholder="Repite password">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="precio" class="col-sm-4 col-form-label col-form-label-sm">Área</label>
                                              <div class="col-sm-8">
                                                <select  class="form-control form-control-sm" id="area">
                                                  <?php
                                                      $areas = getAreas();
                                                      foreach ($areas as $key => $value) {
                                                        echo '<option value = "'.$key.'">'.$value.'</option>';
                                                      }
                                                  ?>
                                                </select>
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
    <script src ="<?php echo PATH; ?>js/user/console_add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

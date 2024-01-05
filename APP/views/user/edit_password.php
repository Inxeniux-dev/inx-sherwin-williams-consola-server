<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Cambiar Password</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">

                              <?php

                                $almacenes = $data["almacenes"];
                                $almacen_user = $data["almacen_user"];

                              ?>

                              <div class="invoi">
                                  <div class="row">
                                    <div class="col-sm-12">
                                         <h5 class ="text-primary"><b>Cambiar Password del Usuario</b></h5>
                                      </div>
                                  </div>
                              </div>



                              <div class="invoi invoi-blue">
                                  <div class="row">
                                          <div class="col-md-12 col-12">
                                              <div class="table-responsive  mt-3">
                                                      <table class="table  table-sm">
                                                          <tbody>
                                                            <tr>
                                                                <td class="text-blanco spacing">Usuario :</td>
                                                                <td class="text-blanco spacing" align = "right"><b><?php echo $data["user"]->nombre; ?></b></td>
                                                            </tr>
                                                          </tbody>
                                                      </table>

                                              </div>
                                          </div>
                                  </div>
                              </div>



                              <div class="invoi">
                                          <div class="row">

                                                <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                                       <h5><i class="fas fa-info-circle"></i> Ingrese los datos solicitados </h5>
                                                  </div>
                                                  <div class="col-md-3 col-sm-12 col-12 "></div>
                                                  <div class="col-md-6 col-sm-12 col-12 ">

                                                    <input type = "hidden" id = "iduser" value = "<?php echo $data["user"]->iduser; ?>">
                                                    <input type = "hidden" id = "id_sistema" value = "<?php echo $data["user"]->id_sistema; ?>">

                                                    <div class="form-group row">
                                                        <label for="password" class="col-sm-4 col-form-label col-form-label-sm">Motivo</label>
                                                        <div class="col-sm-8">
                                                        <input type="password" class="form-control form-control-sm" id="password" placeholder="Ingrese password">
                                                        </div>
                                                    </div>
                                                      <div class="form-group row">
                                                          <label for="repassword" class="col-sm-4 col-form-label col-form-label-sm">Motivo</label>
                                                          <div class="col-sm-8">
                                                          <input type="password" class="form-control form-control-sm" id="repassword" placeholder="Repita password">
                                                          </div>
                                                      </div>
                                                      <button class = "btn my-btn-blue float-right" style="width:250px;" onclick = "updatePass();"><i class="fas fa-check-circle"></i> Actualizar Password</button>
                                                  </div>

                                          </div>

                              </div>



                              <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                    </div>
                </div>
          </div>
      </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/user/edit_password.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

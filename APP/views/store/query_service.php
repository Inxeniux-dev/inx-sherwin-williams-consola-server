<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-12">
                               <h5 class ="text-primary"><i class="fas fa-database"></i> Servicio para Query en Sucursal</h5>
                            </div>
                        </div>
                    </div>

                    <?php

                      if($data["store"])
                      {
                          $store = $data["store"]->fetch_object();
                      }

                    ?>

                        <div class="invoi invoi-blue">
                            <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Clave :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $store->idsucursal; ?></b></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="text-blanco spacing">Sucursal :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $store->nombre; ?></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">IP Remota :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $store->ip; ?></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>


                        <div class="invoi ">
                            <div class="row">
                                  <div class = "col-12">
                                      <div class = "alert alert-warning">
                                          <h5><i class="fas fa-exclamation-triangle"></i><b> Está función modificará la estructura o la información de la base de datos de la tienda.</b></h5>
                                      </div>
                                      <div class = "alert alert-warning">
                                          <h5><i class="fas fa-exclamation-triangle"></i><b> Asegurece de ingresar la sentencia SQL correcta, de lo contrario puede ocasionar problemas en la información.</b></h5>
                                      </div>
                                      <div class = "alert alert-warning">
                                          <h5><i class="fas fa-exclamation-triangle"></i><b> Este proceso se registrará en una Bitácora</b></h5>
                                      </div>
                                      <div class = "alert alert-warning">
                                          <h5><i class="fas fa-exclamation-triangle"></i><b> Realice estos cambios considerando poco movimiento en la sucursal</b></h5>
                                      </div>
                                  </div>
                            </div>
                          </div>



                          <div class="invoi">
                                      <div class="row">

                                            <div class="col-md-12 col-sm-12 col-12">
                                                   <h5><i class="fas fa-terminal"></i> Ingrese la sentencia SQL </h5>
                                              </div>

                                              <div class="col-md-12 col-sm-12 col-12 ">
                                                      <div class="form-group row">
                                                          <label for="user" class="col-sm-4 col-form-label col-form-label-sm">Usuario</label>
                                                          <div class="col-sm-8">
                                                          <input type="text" class="form-control form-control-sm" value='<?php echo $_SESSION["datauser"]["name"]; ?>' readonly>
                                                          </div>
                                                      </div>

                                                      <div class="form-group row">
                                                          <label for="sentence" class="col-sm-4 col-form-label col-form-label-sm">Sentencia SQL</label>
                                                          <div class="col-sm-8">
                                                          <textarea class="form-control" rows = "10" id="sentence"></textarea>
                                                          </div>
                                                      </div>
                                              </div>
                                      </div>

                          </div>

                          <div class="invoi">
                                <div class="row">
                                      <div class="col-md-12 col-sm-12 col-12">
                                            <button class = "btn my-btn-blue float-right btn-send" style="width:450px;"><i class="fas fa-check-circle"></i> Ejecutar Script</button>
                                      </div>
                                </div>
                          </div>



                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/store/query_service.js"></script>
</body>
</html>

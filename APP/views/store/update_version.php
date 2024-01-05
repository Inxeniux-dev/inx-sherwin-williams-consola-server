<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Historial de Versiones</title>
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
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Actualizar Versión  de Tienda</h5>
                            </div>
                        </div>
                    </div>


                    <?php
                        $store = $data["store"] ? $data["store"]->fetch_object() : null;
                     ?>

                    <div class="invoi invoi-blue">
                        <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="table-responsive  mt-3">
                                            <table class="table  table-sm">
                                                <tbody>
                                                  <tr>
                                                      <td class="text-blanco spacing">Sucursal :</td>
                                                      <td class="text-blanco spacing" align = "right"><b><?php echo addCeros($store->idsucursal)."-".$store->nombre; ?></b></td>
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
                                           <h5><i class="fas fa-code-branch"></i> Información </h5>
                                      </div>
                                      <div class="col-3"></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                                    
                                                <div class="form-group row">
                                                      <label for="version" class="col-sm-4 col-form-label col-form-label-sm">Versión</label>
                                                      <div class="col-sm-8">
                                                        <select class="form-control form-control-sm" id = "version">
                                                            <option value = '0'>Antiguo PDV</option>
                                                            <option value = '1'>Nuevo PDV</option>
                                                        </select>
                                                      </div>
                                                  </div>

                                                  <div class="form-group row">
                                                      <label for="ip" class="col-sm-4 col-form-label col-form-label-sm">IP Hamachi</label>
                                                      <div class="col-sm-8">
                                                      <input type="text" class="form-control form-control-sm" value='' id="ip" name="ip" placeholder="Ingrese IP">
                                                      </div>
                                                  </div>

                                                  <button class = "btn my-btn-blue float-right btn-upd" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                      </div>
                              </div>

                  </div>



                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php echo "<script>let id = '".$store->idsucursal."'; </script>"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/store/version_update.js"></script>
</body>
</html>

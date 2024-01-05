<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Versión</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-code-branch"></i> Crear Nueva Versión</h5>
                            </div>
                        </div>
                    </div>




                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-code-branch"></i> Detalles de la versión </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                                  <div class="form-group row">
                                                      <label for="version" class="col-sm-4 col-form-label col-form-label-sm">Versión</label>
                                                      <div class="col-sm-8">
                                                      <input type="text" class="form-control form-control-sm" value='' id="version" name="version" placeholder="Ingrese Versión">
                                                      </div>
                                                  </div>

                                                  <div class="form-group row">
                                                      <label for="proyecto" class="col-sm-4 col-form-label col-form-label-sm">Proyecto</label>
                                                      <div class="col-sm-8">
                                                        <select class="form-control form-control-sm" id="proyecto">
                                                            <option value = "0"> Seleccione </option>
                                                            <?php
                                                                $proyects = $data["proyects"];
                                                                while($row = $proyects->fetch_object())
                                                                {
                                                                    echo '<option value = "'.$row->id.'">'.$row->nombre.'</option>';
                                                                }
                                                             ?>

                                                        </select>
                                                      </div>
                                                  </div>

                                                  <button class = "btn my-btn-blue float-right btn-save" style="width:250px;"><i class="fas fa-check-circle"></i> Crear</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/version/create.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

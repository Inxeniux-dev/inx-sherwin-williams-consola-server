<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Edit Linea</title>
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


                    <?php 
                         $line = $data->fetch_object();
                    ?>

                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos de la linea </h5>
                                      </div>

                                      <input type = "hidden" id = "id_line" value = "<?php echo $line->idlinea;?>">

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="key" class="col-sm-4 col-form-label col-form-label-sm">Clave</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $line->idlinea; ?>' id="key" name="key" placeholder="Ingrese Clave">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="linea" class="col-sm-4 col-form-label col-form-label-sm">Nombre de la línea</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $line->descripcion; ?>' id="linea" name="linea" placeholder="Ingrese línea">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="tipo" class="col-sm-4 col-form-label col-form-label-sm">Tipo</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="tipo" name="tipo">
                                                      <option value = "0"> Seleccione Tipo</option>
                                                      <?php
                                                            if($line->tipo == 1)
                                                            {
                                                              echo '<option value = "1" selected> Pintura</option>';
                                                              echo '<option value = "2"> Complemento</option>';
                                                            }
                                                             if($line->tipo == 2)
                                                            {
                                                              echo '<option value = "1"> Pintura</option>';
                                                              echo '<option value = "2" selected> Complemento</option>';
                                                            }
                                                       ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="igualado" class="col-sm-4 col-form-label col-form-label-sm">¿Para Igualado?</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="igualado" name="igualado">
                                                      <?php
                                                            if($line->para_igualado == 0)
                                                            {
                                                              echo '<option value = "0" selected> No</option>';
                                                              echo '<option value = "1"> Si</option>';
                                                            }
                                                             if($line->para_igualado == 1)
                                                            {
                                                              echo '<option value = "0"> No</option>';
                                                              echo '<option value = "1" selected> Si</option>';
                                                            }
                                                       ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="conversion" class="col-sm-4 col-form-label col-form-label-sm">¿Para Conversión?</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="conversion" name="conversion">
                                                     <?php if($line->para_conversion == 0)
                                                      {
                                                        echo '<option value = "0" selected> No</option>';
                                                        echo '<option value = "1"> Si</option>';
                                                      }
                                                       if($line->para_conversion == 1)
                                                      {
                                                        echo '<option value = "0"> No</option>';
                                                        echo '<option value = "1" selected> Si</option>';
                                                      } ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right" onclick="editLine();" style="width:250px;"><i class="fas fa-check-circle"></i> Editar</button>
                                      </div>
                              </div>
                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/line/edit.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

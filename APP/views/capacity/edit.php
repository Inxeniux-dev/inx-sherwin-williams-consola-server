<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Editar Capacidad</title>
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
                               <h5 class ="text-blanco">Ingresar datos de la Editar</h5>
                            </div>
                        </div>
                    </div>


                     <?php 
                         $capacidad = $data->fetch_object();
                    ?>

                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos de la Editar </h5>
                                      </div>

                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">

                                          <input type = "hidden" id = "id_capacity" value = "<?php echo $capacidad->idcapacidad;?>">

                                          <div class="form-group row">
                                              <label for="key" class="col-sm-4 col-form-label col-form-label-sm">Clave</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $capacidad->idcapacidad; ?>' id="key" name="key" placeholder="Ingrese Clave">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="capacity" class="col-sm-4 col-form-label col-form-label-sm">Capacidad</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $capacidad->capacidad; ?>' id="capacity" name="capacity" placeholder="Ingrese capacidad">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="unidad" class="col-sm-4 col-form-label col-form-label-sm">Unidad</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='<?php echo $capacidad->unidad; ?>' id="unidad" name="unidad" placeholder="Ingrese unidad">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="type" class="col-sm-4 col-form-label col-form-label-sm">Tipo</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="type" name="type">
                                                      
                                                    <?php 
                                                        if($capacidad->tipo == 1){
                                                            echo '<option value = "1" selected>Líquidos</option>
                                                                  <option value = "2">Sólidos</option>';
                                                        } 
                                                         if($capacidad->tipo == 2){
                                                            echo '<option value = "1">Líquidos</option>
                                                                  <option value = "2" selected>Sólidos</option>';
                                                        } 
                                                    ?>

                                                      
                                                      
                                                  </select>
                                              </div>
                                          </div>
                                        
                                          <button class = "btn my-btn-blue float-right" onclick="updateCapacity();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                      </div>

                              </div>

                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/capacity/edit.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

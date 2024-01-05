<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Editar Empleado</title>
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
                               <h5 class ="text-blanco">Editar Empleado</h5>
                            </div>
                        </div>
                    </div>

                    <?php
                        $empleado = $data["empleado"]->fetch_object();
                    ?>

                    <div class="invoi">
                                <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                             <h5><i class="fas fa-info-circle"></i> Datos Generales del Empleado </h5>
                                        </div>

                                        <input type="hidden" id = "idemploye" value = "<?php echo $empleado->idempleado; ?>" />

                                        <div class="col-md-3 col-sm-12 col-12 "></div>
                                        <div class="col-md-6 col-sm-12 col-12 ">

                                          <div class="form-group row">
                                              <label for="nombre" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="nombre"  placeholder="Ingrese nombre" value = "<?php echo $empleado->nombre; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="apellido" class="col-sm-4 col-form-label col-form-label-sm">Apellido</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="apellido"  placeholder="Ingrese nombre" value = "<?php echo $empleado->apellido; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="num_empleado" class="col-sm-4 col-form-label col-form-label-sm">Número de Empleado</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="num_empleado"  placeholder="Ingrese nombre" value = "<?php echo $empleado->no_empleado; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="codigo" class="col-sm-4 col-form-label col-form-label-sm">Sucursal Base</label>
                                              <div class="col-sm-8">
                                                <select class="form-control form-control-sm" id="sucursal">
                                                    <option value = "00"  selected>00-Matriz</option>
                                                    <?php
                                                        while($row = $data["stores"]->fetch_object())
                                                        {
                                                                $selected = $row->idsucursal == $empleado->idsucursal ? "selected" : "";
                                                                echo '<option value = "'.$row->idsucursal.'"  '.$selected.'>'.addCeros($row->idsucursal).'-'.$row->nombre.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                              </div>
                                          </div>

                                          <div class = "alert alert-info">
                                              Si necesita <b>actualizar la huella digital</b>, utilice el <b>Sistema de Gestión de Huellas Digitales</b>
                                          </div>

                                          <button class = "btn my-btn-blue float-right" onclick="edit();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                        </div>

                                </div>

                    </div>



                    <div class="invoi">
                                <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                             <h5><i class="fas fa-info-circle"></i> Datos Avanzados del Empleado </h5>
                                        </div>

                                        <div class="col-md-3 col-sm-12 col-12 "></div>
                                        <div class="col-md-6 col-sm-12 col-12 ">

                                          <div class="form-group row">
                                              <label for="username" class="col-sm-4 col-form-label col-form-label-sm">Username</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" id="username"  placeholder="Ingrese username" value = "<?php echo $empleado->username; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="password" class="col-sm-4 col-form-label col-form-label-sm">Password</label>
                                              <div class="col-sm-8">
                                              <input type="password" class="form-control form-control-sm" id="password"  placeholder="Ingrese password" value = "<?php echo $empleado->password; ?>">
                                              </div>
                                          </div>
                                          
                                          <br><hr>

                                          <div class="form-group row">
                                              <label for="add_pintor" class="col-sm-4 col-form-label col-form-label-sm"><b>Agregar Pintores</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="add_pintor" <?php echo $empleado->add_pintor == 1 ? "checked" : ""; ?>>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="list_pintor" class="col-sm-4 col-form-label col-form-label-sm"><b>Listar Pintores</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="list_pintor" <?php echo $empleado->list_pintor == 1 ? "checked" : ""; ?>>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="add_user" class="col-sm-4 col-form-label col-form-label-sm"><b>Agregar Empleados</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="add_user" <?php echo $empleado->add_user == 1 ? "checked" : ""; ?>>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="list_user" class="col-sm-4 col-form-label col-form-label-sm"><b>Listar Empleados</b></label>
                                              <div class="col-sm-8">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="list_user" <?php echo $empleado->list_user == 1 ? "checked" : ""; ?>>
                                                  </div>
                                              </div>
                                          </div>


                                          <button class = "btn my-btn-blue-only-border float-right" onclick = 'saveSecurity();' style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                                        </div>

                                </div>

                    </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/empleado/edit.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

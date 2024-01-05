<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Asignar Almacenes</title>
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
                                         <h5 class ="text-primary"><b>Asígnar Almacenes al Usuario (para Libreta de Pagos)</b></h5>
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
                                                       <h5><i class="fas fa-info-circle"></i> Seleccione el almacén </h5>
                                                  </div>
                                                  <div class="col-md-3 col-sm-12 col-12 "></div>
                                                  <div class="col-md-6 col-sm-12 col-12 ">
                                                      <div class="form-group row">
                                                          <label for="date" class="col-sm-4 col-form-label col-form-label-sm">Almacén</label>

                                                          <input type = "hidden" id = "iduser" value = "<?php echo $data["user"]->iduser; ?>">

                                                          <div class="col-sm-8">
                                                              <select class="form-control form-control-sm" id="almacen">
                                                                  <option value = "0">Seleccione Almacén</option>
                                                                  <?php
                                                                      while($row = $almacenes->fetch_object())
                                                                      {
                                                                        echo "<option value = '".$row->idalmacen."'>".$row->clave."-".$row->nombre."</option>";
                                                                      }
                                                                  ?>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <button class = "btn my-btn-blue float-right" style="width:250px;" onclick = "add();"><i class="fas fa-check-circle"></i> Agregar</button>
                                                  </div>

                                          </div>

                              </div>


                              <div class="invoi">
                                <div class="table-responsive" style='min-height: 150px;'>
                                  <table class = "table table-hover table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Clave</th>
                                                  <th>Almacén</th>
                                                  <th></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          <?php
                                                while($row = $almacen_user->fetch_object())
                                                {
                                                    echo '<tr>
                                                              <td>'.$row->clave.'</td>
                                                              <td>'.$row->nombre.'</td>
                                                              <td align = "center">
                                                                  <div class="dropdown">
                                                                      <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                          <i class="fa fa-ellipsis-h"></i>
                                                                      </button>
                                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                                        <a class="dropdown-item" href="javascript:void(0);" onclick = "eliminar('.$row->idalmacen.', '.$row->iduser.');"><i class="fas fa-trash"></i> Eliminar</a>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                          </tr>';
                                                }
                                          ?>
                                        </tbody>
                                  </table>
                                </div>
                             </div>

                              <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                    </div>
                </div>
          </div>
      </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/user/console_add_store.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

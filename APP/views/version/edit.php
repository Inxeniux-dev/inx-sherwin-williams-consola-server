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
                          <div class="col-sm-8">
                               <h5 class ="text-primary"><i class="fas fa-file-invoice"></i> Detalle de la Versión </h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                    <button class = 'btn my-btn-blue dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                          <i class="fas fa-file-export"></i> Exportar
                                    </button>
                                        <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                <a class="dropdown-item text-default r-xls" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-excel"></i> Exportar a Excel
                                                </a>
                                                <a class="dropdown-item text-default r-pdf" href="javascript:void(0);" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        $version = $data["version"] ? $data["version"]->fetch_object() : null;
                        $estado = "";
                        $s1 = '';
                        $s2 = '';
                        $s3 = '';
                        $str_fecha = 'Creación';
                        if($version->status == 0){ $estado = '<i class="fas fa-rocket"></i> Producción'; $s1 = "selected"; $str_fecha = 'Liberación'; }
                        if($version->status == 1){ $estado = '<i class="fas fa-laptop-code"></i> Desarrollo'; $s2 = "selected"; }
                        if($version->status == 2){ $estado = '<i class="fas fa-vial"></i> Pruebas'; $s3 = "selected"; }
                     ?>

                    <div class="invoi invoi-blue">
                        <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive  mt-3">
                                            <table class="table  table-sm">
                                                <tbody>
                                                  <tr>
                                                      <td class="text-blanco spacing">Versión :</td>
                                                      <td class="text-blanco spacing" align = "right"><b><?php echo $version->version; ?></b></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="text-blanco spacing">Fecha de <?php echo $str_fecha; ?> :</td>
                                                      <td class="text-blanco spacing" align = "right"><b><?php echo fechaCorta($version->create_at); ?></b></td>
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
                                                          <td class="text-blanco spacing">Cambiar Estado :</td>
                                                          <td class="text-blanco spacing" align = "right">
                                                            <select class="form-control form-control-sm" id="status">
                                                                <option value = "1"  <?php echo $s2; ?>> Desarrollo </option>
                                                                <option value = "2"  <?php echo $s3; ?>> Pruebas </option>
                                                                <option value = "0" <?php echo $s1; ?>> Producción </option>
                                                            </select>
                                                          </td>
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
                                           <h5><i class="fas fa-code-branch"></i> Detalles de la versión </h5>
                                      </div>
                                      <div class="col-md-3 col-sm-12 col-12 "></div>
                                      <div class="col-md-6 col-sm-12 col-12 ">
                                            <div class="form-group row">
                                                <label for="descripcion" class="col-sm-4 col-form-label col-form-label-sm">Descripción</label>
                                                <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" value='' id="descripcion" name="descripcion" placeholder="Ingrese Descripción">
                                                </div>
                                            </div>
                                            <button class = "btn my-btn-blue float-right btn-save" style="width:250px;"><i class="fas fa-check-circle"></i> Agregar</button>
                                      </div>

                              </div>

                  </div>



                    <div class="invoi">

                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                          <h5><i class="fas fa-info-circle"></i> Detalle de Cambios </h5>
                      </div>
                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">

                        <?php
                        if($data["detalle"]->num_rows == 0)
                        {
                           echo  "<div class = 'alert alert-info'><b>Aún no se agrega una caracteristica a la versión</b></div>";
                        }
                        else {
                        ?>

                            <div class="table-responsive" >
                                <table class = "table table-hover table-striped">
                                    <thead>
                                        <th>Descripción</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $count = 0;
                                        while($row = $data["detalle"]->fetch_object())
                                        {
                                          $count++;
                                            echo "<tr id = 'tr".$row->id."'>
                                                    <td><b>".$count.") </b>".$row->detalle."</td>
                                                    <td align = 'center'><i class='fas fa-trash-alt hand' title = 'Eliminar' style = 'color:#ff5a5a;' onclick = 'deleteComent(".$row->id.")'></i></td>
                                                  </tr>";
                                        }
                                      ?>
                                    </tbody>
                                </table>
                            </div>

                          <?php } ?>
                          </div>
                        </div>



                        <div class="invoi">
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                             <h5><i class="fas fa-file-code"></i> Componentes de la versión </h5>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-12 "></div>
                                         <div class="col-md-6 col-sm-12 col-12 ">
                                                 <div class="form-group row">
                                                     <label for="nombre" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                                                     <div class="col-sm-8">
                                                     <input type="text" class="form-control form-control-sm" value='' id="nombre" name="nombre" placeholder="Ingrese nombre">
                                                     </div>
                                                 </div>

                                                    <div class="form-group row">
                                                        <label for="file" class="col-sm-4 col-form-label col-form-label-sm">Cargar Archivos</label>
                                                        <div class="col-sm-8">
                                                        <input multiple type="file" id="file" name="file" >
                                                        </div>
                                                    </div>

                                                    <button class = "btn my-btn-blue float-right btn-upload" style="width:250px;"><i class="fas fa-check-circle"></i> Cargar</button>

                                        </div>
                                    </div>

                        </div>

                        <div class="invoi">

                          <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                              <h5><i class="fas fa-cogs"></i> Componentes para la instalación</h5>
                          </div>
                          <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                <div class="table-responsive">
                                    <table class = "table table-sm">
                                        <thead>
                                            <th>#</th>
                                            <th>Archivo</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
                                            <th style="text-align:center;">Descargar</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $count = 0;
                                            while($row = $data["files"]->fetch_object())
                                            {
                                              $count++;
                                              $path = explode(".", $row->path);
                                              $value = '';
                                              foreach ($path as $key => $value) {
                                                  $tipo = $value;
                                              }

                                              $path_download = PATH_FILES_VERSION.$version->version."\\".$row->path;

                                                echo '<tr>
                                                        <td><b>'.$count.'</b></td>
                                                        <td><b>'.$row->nombre.'</b></td>
                                                        <td>'.strtoupper($tipo).'</td>
                                                        <td>'.$row->create_at.'</td>
                                                        <td align = "center">';
                                                            if(isset($_SESSION["permissions"][42]) && $_SESSION["permissions"][42]->status == 1)
                                                            {
                                                                echo '<a title="Descargar Archivo" href="../../downloadsys/'.$row->id.'/"> <i class="fas fa-download"></i> </a>';
                                                            }
                                                  echo '<td>';
                                                          echo '<div class="dropdown">
                                                                  <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                      <i class="fa fa-ellipsis-h"></i>
                                                                  </button>
                                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick = "deleteFile('.$row->id.')"><i class="fas fa-trash"></i> Eliminar</a>
                                                                  </div>
                                                            </div>';
                                                       echo '</td>
                                                      </tr>';
                                            }
                                          ?>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php echo "<script>let id = '".$version->id."'; </script>"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/version/detail.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

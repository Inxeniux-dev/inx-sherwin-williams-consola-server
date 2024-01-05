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

                      <?php
                          $version = $data["version"] ? $data["version"]->fetch_object() : null;
                      ?>

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
                                                <a class="dropdown-item text-default r-pdf" href="../../../report/versionDetails/<?php echo $version->id; ?>/" target="_blank">
                                                    <i class="far fa-file-pdf"></i> Exportar a PDF
                                                </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        $permisos = json_decode($_SESSION["datauser"]["permissions"])->Versionamiento;
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
                                                          <td class="text-blanco spacing">Estado :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $estado; ?></b></td>
                                                      </tr>
                                                      <tr>

                                                            <td class="text-blanco spacing" align="right">
                                                                 <td class="text-blanco spacing" align = "right">

                                                                 </td>
                                                            </td>
                                                      </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="invoi">

                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                          <h5><i class="fas fa-info-circle"></i> Detalle de Cambios </h5>
                      </div>
                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">

                            <div class="table-responsive" >
                                <table class = "table table-hover table-striped">
                                    <thead>
                                        <th>Descripción</th>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $count = 0;
                                        while($row = $data["detalle"]->fetch_object())
                                        {
                                          $count++;
                                            echo "<tr>
                                                    <td><b>".$count.") </b>".$row->detalle."</td>
                                                  </tr>";
                                        }
                                      ?>
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>




                        <div class="invoi">

                          <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                              <h5><i class="fas fa-cogs"></i> Archivos para la instalación</h5>
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

                                                        if($permisos->Listado_de_Versiones->Consultar){
                                                            echo '<a title="Descargar Archivo" href="../../downloadsys/'.$row->id.'/"> <i class="fas fa-download"></i> </a>';
                                                        }

                                                  echo '</td>
                                                        <td>';
                                                          if($version->status == 0){

                                                            if($permisos->Listado_de_Versiones->Editar){
                                                                echo '<div class="dropdown">
                                                                        <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-h"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                          <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                                          <a class="dropdown-item" href="javascript:void(0);" onclick = "deleteFile('.$row->id.')"><i class="fas fa-trash"></i> Eliminar</a>
                                                                        </div>
                                                                  </div>';
                                                            }
                                                          }
                                                       echo '</td>
                                                      </tr>';
                                            }
                                          ?>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>



                        <?php if($permisos->Listado_de_Versiones->Editar){ ?>

                            <div class="invoi">

                                <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                    <h5><i class="fas fa-store"></i> Sucursales a Instalar</h5>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                      <div class="table-responsive">
                                          <table class = "table table-hover table-striped table-sm">
                                              <thead>
                                                  <th>Sucursal</th>
                                                  <th style = "text-align:center">¿Instalar?</th>
                                              </thead>
                                              <tbody>
                                                <?php


                                                $permitidas = json_decode($version->sucursales);
                                                $sucursales = array();
                                                if(count($permitidas) > 0 )
                                                {
                                                  foreach ($permitidas as $key => $value) {
                                                      $sucursales[] = $key;
                                                  }
                                                }

                                                  $count = 0;
                                                  while($row = $data["sucursal"]->fetch_object())
                                                  {

                                                    if($row->status == 1 && ($row->almacen == 0 || $row->almacen == 3))
                                                    {
                                                        $check = '';
                                                        if(in_array(addCeros($row->idsucursal), $sucursales)) {
                                                            $check = 'checked';
                                                        }

                                                        $count++;

                                                            echo '<tr>
                                                                  <td><b>'.addCeros($row->idsucursal).'-'.$row->nombre.'</b></td>
                                                                  <td align = "center">
                                                                      <input class="form-check-input" type="checkbox" data = "'.$row->idsucursal.'" '.$check.'>
                                                                  </td>
                                                                </tr>';
                                                      }
                                                  }
                                                ?>
                                              </tbody>
                                          </table>
                                      </div>
                                    </div>


                                    <div class="col-md-12 col-sm-12 col-12 my-4">
                                        <button class = "btn my-btn-blue float-right btn-upd-all" style="width:250px;"><i class="fas fa-check-circle"></i> Instalar Todas</button>
                                    </div>

                                </div>


                              <?php  } ?>


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

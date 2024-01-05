<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Lineas</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <?php 
                            $lines = $data;

                    ?>

                    <div class="invoi  invoi-blue">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-blanco">Listado de Lineas</h5>
                            </div>
                            <div class="col-sm-4">
                             <a href="./add/" class="btn my-btn-blanco btn-sm float-right" style="margin-right:15px;"><i class="fa fa-plus-circle"></i> Agregar Linea</a>
                            </div>
                        </div>
                    </div>

                        <div class="invoi">
                          <div class="table-responsive table-prices" style='min-height: 50px;'>
                                <table class = "table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Clave</th>
                                            <th style="text-align: right;">Línea</th>
                                            <th style="text-align: center;">Tipo</th>
                                            <th style="text-align: center;">Para Igualado</th>
                                            <th style="text-align: center;">Para Conversión</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = $lines->fetch_object())
                                            {

                                                $tipo = $row->tipo == 1 ? "Pintura": "Complemento";
                                                $para_igualado = $row->para_igualado == 1 ? "Si": "No";
                                                $para_conversion = $row->para_conversion == 1 ? "Si": "No";



                                                echo "<tr>
                                                        <td align = 'center'>".$row->idlinea."</td>
                                                        <td align = 'right'><b>".$row->descripcion."</td>
                                                        <td align = 'center'>".$tipo."</td>
                                                        <td align = 'center'>".$para_igualado."</td>
                                                        <td align = 'center'>".$para_conversion."</td>
                                                        <td align = 'center'>
                                                             <div class='dropdown'>
                                                                    <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='fa fa-ellipsis-h'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                      <h6 class='dropdown-header'>
                                                                        <b>Opciones</b>
                                                                      </h6>

                                                                      <a class='dropdown-item' href='./edit/".$row->idlinea."/' >
                                                                        <i class='fa fa-edit'></i> Editar</a>

                                                                        <div class='dropdown-divider'></div>

                                                                       <a class='dropdown-item' href='javascript:void(0);' onclick = 'deleteLine(".$row->idlinea.");'>
                                                                        <i class='fa fa-trash'></i> Eliminar</a>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                </tr>";
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
    <script src ="<?php echo PATH; ?>js/line/delete.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Vendedores</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <?php 
                            $sellers = $data;

                    ?>

                    <div class="invoi  invoi-blue">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-blanco">Listado de Vendedores</h5>
                            </div>
                            <div class="col-sm-4">
                                 <a href="./add/" class="btn my-btn-blanco btn-sm float-right" style="margin-right:15px;"><i class="fa fa-plus-circle"></i> Agregar Vendedor</a>
                            </div>
                        </div>
                    </div>

                        <div class="invoi">
                          <div class="table-responsive table-prices" style='min-height: 150px;'>
                                <table class = "table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Id</th>
                                            <th>Nombre</th>
                                            <th style="text-align: right;">Objetivo</th>
                                            <th style="text-align: center;">Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = $sellers->fetch_object())
                                            {

                                                $estado = $row->status == 1 ? '<h6><span class="badge badge-success">Activo</span></h6>' : '<h6><span class="badge badge-danger">Eliminado</span></h6>';

                                                echo "<tr>
                                                        <td align = 'center'>".$row->idvendedor."</td>
                                                        <td>".$row->nombre."</td>
                                                        <td align = 'right'><b>$".number_format($row->objetivo, 2, '.', ',')."</b></td>
                                                        <td align = 'center'>".$estado."</td>
                                                        <td align = 'center'>";

                                                        if($row->idvendedor != 1 && $row->status == 1)
                                                        {
                                                             echo "<div class='dropdown'>
                                                                    <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='fa fa-ellipsis-h'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                      <h6 class='dropdown-header'>
                                                                        <b>Opciones</b>
                                                                      </h6>

                                                                        <a class='dropdown-item' href='./edit/".$row->idvendedor."/' >
                                                                        <i class='fa fa-edit'></i> Editar</a>

                                                                        <div class='dropdown-divider'></div>

                                                                      <a class='dropdown-item' href='javascript:void(0);' onclick = 'deleteSeller(".$row->idvendedor.");'>
                                                                        <i class='fa fa-trash'></i> Eliminar</a>
                                                                      </div>
                                                               </div>";

                                                            }
                                                        echo "</td>
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
    <script src ="<?php echo PATH; ?>js/seller/delete.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

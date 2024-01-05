<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>User CRM</title>
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
                                    <h5 class="text-blanco"><i class="fas fa-users"></i> Usuario del sistema CRM</h5>
                                  </div>
                                  <div class="col-sm-4">
                                        <a href="../createUserCRM/" class="btn my-btn-blanco btn-sm float-right"><i class="fas fa-user"></i> Nuevo Usuario</a>
                                   </div>
                        </div>
                    </div>

                    <div class="invoi">
                        <div class="table-responsive table-prices" style='min-height: 250px;'>
                              <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Username</th>
                                            <th><small><b>Últ Actualización</b></small></th>
                                            <th style="text-align:center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                          $users = $data;
                                          if($users)
                                          {
                                              while($row = $users->fetch_object())
                                              {
                                                echo '<tr>
                                                          <td>'.$row->iduser.'</td>
                                                          <td>'.$row->nombre.'</td>
                                                          <td><b>'.$row->username.'</b></td>
                                                          <td>'.$row->update_at.'</td>
                                                          <td align = "center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="../crmEdit/'.$row->iduser.'/" ><i class="fas fa-user-edit"></i> Editar</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="../edidPassword/'.$row->iduser.'/" ><i class="fas fa-key"></i> Cambiar Password</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick = "deleteUser('.$row->iduser.', '.$row->id_sistema.');" ><i class="fas fa-trash"></i> Eliminar </a>
                                                             </div>
                                                          </td>
                                                      </tr>';
                                            }
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
    <script src ="<?php echo PATH; ?>js/user/delete_user.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

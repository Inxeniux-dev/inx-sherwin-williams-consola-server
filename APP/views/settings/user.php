<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Users</title>
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
                          <div class="col-sm-12">
                               <h5 class ="text-blanco">Usuarios</h5>
                            </div>
                        </div>
                    </div>



                    <div class="invoi">
                        <div class="row">
                              <div class="col-md-4 col-sm-12 col-4 ">
                                  <div class="row">
                                      <a href= "../../user/console/" style="width: 100%;">
                                        <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                            <h5><i class="fas fa-terminal"></i> Server Console</h5>
                                            <label>Usuarios del Sistema <b>Console</b></label>
                                        </div>
                                      </a>
                                  </div>
                              </div>

                               <div class="col-md-4 col-sm-12 col-4 ">
                                  <div class="row">
                                    <a href= "../../user/pos/" style="width: 100%;">
                                        <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                            <h5><i class="fas fa-store"></i> Punto de Venta</h5>
                                            <label>Usuarios del <b>Punto de Venta</b></label> <i class="fas fa-globe"></i> <i class="fas fa-sync-alt"></i>
                                        </div>
                                    </a>
                                  </div>
                              </div>

                              <div class="col-md-4 col-sm-12 col-4 ">
                                  <div class="row">
                                    <a href= "../../user/crm/" style="width: 100%;">
                                        <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                            <h5><i class="fa fa-users" aria-hidden="true"></i> CRM</h5>
                                            <label>Usuarios del <b>CRM</b></label> <i class="fas fa-globe"></i> <i class="fas fa-sync-alt"></i>
                                        </div>
                                    </a>
                                  </div>
                              </div>

                        <!--      <div class="col-md-4 col-sm-12 col-4 ">
                                 <div class="row">
                                   <a href= "../../user/inventory/" style="width: 100%;">
                                       <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                           <h5><i class="fas fa-dolly-flatbed"></i> Almacén</h5>
                                           <label>Usuarios del <b>Sistema de Almacén</b> (en Desarrollo)</label> <i class="fas fa-globe"></i> <i class="fas fa-sync-alt"></i>
                                       </div>
                                   </a>
                                 </div>
                             </div>-->
                        </div>
                    </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list.js"></script>
</body>
</html>

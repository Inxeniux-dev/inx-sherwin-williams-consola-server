<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Settings</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


          <?php
              $config = $data;
          ?>
              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi  invoi-blue">
                        <div class="row">
                          <div class="col-sm-12">
                               <h5 class ="text-blanco">Configuración del Sistema</h5>
                            </div>
                        </div>
                    </div>

                    <div class="invoi">
                         <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                      <h5><i class="far fa-folder-open"></i> Rutas para Gestión de Ficheros </h5>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                         <div class="form-group row">
                                            <label for="path_backup" class="col-sm-4 col-form-label col-form-label-sm">Path Respaldos Tiendas</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_backup; ?>' id="path_backup" placeholder="Ingrese directorio">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                           <label for="path_log" class="col-sm-4 col-form-label col-form-label-sm">Path Logs Tiendas</label>
                                           <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_log; ?>' id="path_log" placeholder="Ingrese directorio">
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="path_prices" class="col-sm-4 col-form-label col-form-label-sm">Path Archivo de Precios</label>
                                          <div class="col-sm-6">
                                               <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_prices; ?>' id="path_prices" placeholder="Ingrese directorio">
                                          </div>
                                      </div>
                                 </div>

                                 <div class="col-md-6 col-sm-12 col-12 ">
                                       <div class="form-group row">
                                          <label for="path_upload" class="col-sm-4 col-form-label col-form-label-sm">Path Archivos de Versiones</label>
                                          <div class="col-sm-6">
                                               <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_upload; ?>' id="path_upload" placeholder="Ingrese directorio">
                                          </div>
                                      </div>

                                     <div class="form-group row">
                                        <label for="path_transfer" class="col-sm-4 col-form-label col-form-label-sm">Path Archivos de Vales</label>
                                        <div class="col-sm-6">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_transfer; ?>' id="path_transfer" placeholder="Ingrese directorio">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="path_orders" class="col-sm-4 col-form-label col-form-label-sm">Path Pedidos de Tiendas</label>
                                       <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $config->path_orders; ?>' id="path_orders" placeholder="Ingrese directorio">
                                       </div>
                                   </div>

                                 </div>
                         </div>

                         <div class="col-md-12 col-sm-12 col-12 my-4">
                              <button class = "btn my-btn-blue float-right" onclick="addPaths();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                         </div>
                    </div>


                    <div class="invoi">
                         <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                      <h5><i class="fas fa-sync-alt"></i> Sincronización con Tiendas </h5>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                           <div class="form-group row">
                                               <label for="sync_lines" class="col-sm-8 col-form-label col-form-label-sm hand">Sincronizar Líneas</label>
                                               <div class="col-sm-2">
                                                   <div class="form-check">
                                                       <?php
                                                           $check = $config->sync_lines == 1 ? "checked":"";
                                                       ?>
                                                       <input class="form-check-input hand" type="checkbox" value="" id="sync_lines" <?php echo $check; ?>>
                                                   </div>
                                               </div>
                                           </div>


                                           <div class="form-group row">
                                               <label for="sync_cards" class="col-sm-8 col-form-label col-form-label-sm hand">Sincronizar Tarjeta Puntos</label>
                                               <div class="col-sm-2">
                                                   <div class="form-check">
                                                       <?php
                                                           $check = $config->sync_cards == 1 ? "checked":"";
                                                       ?>
                                                       <input class="form-check-input hand" type="checkbox" value="" id="sync_cards" <?php echo $check; ?>>
                                                   </div>
                                               </div>
                                           </div>

                                            <div class="form-group row">
                                               <label for="sync_sellers" class="col-sm-8 col-form-label col-form-label-sm hand">Sincronizar Vendedores</label>
                                               <div class="col-sm-2">
                                                   <div class="form-check">
                                                       <?php
                                                           $check = $config->sync_sellers == 1 ? "checked":"";
                                                       ?>
                                                       <input class="form-check-input hand" type="checkbox" value="" id="sync_sellers" <?php echo $check; ?>>
                                                   </div>
                                               </div>
                                           </div>


                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                         <div class="form-group row">
                                             <label for="sync_user" class="col-sm-8 col-form-label col-form-label-sm hand">Sincronizar Usuarios</label>
                                             <div class="col-sm-2">
                                                 <div class="form-check">
                                                     <?php
                                                         $check = $config->sync_users == 1 ? "checked":"";
                                                     ?>
                                                     <input class="form-check-input hand" type="checkbox" value="" id="sync_users" <?php echo $check; ?>>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="sync_stores" class="col-sm-8 col-form-label col-form-label-sm hand">Sincronizar Catálogo de Sucursales</label>
                                             <div class="col-sm-2">
                                                 <div class="form-check">
                                                     <?php
                                                         $check = $config->sync_stores == 1 ? "checked":"";
                                                     ?>
                                                     <input class="form-check-input hand" type="checkbox" value="" id="sync_stores" <?php echo $check; ?>>
                                                 </div>
                                             </div>
                                         </div>


                                 </div>
                         </div>

                         <div class="col-md-12 col-sm-12 col-12 my-4">
                              <button class = "btn my-btn-blue float-right" onclick="updateSync();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                         </div>
                    </div>



                    <div class="invoi">
                         <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                      <h5><i class="fa fa-file"></i> Conexión para Libreta de Pagos </h5>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                         <div class="form-group row">
                                            <label for="user_db" class="col-sm-4 col-form-label col-form-label-sm">User Base de Datos Almacén</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="user_db" placeholder="Ingrese usuario" autocomplete="off" value = "<?php echo $config->user_db_notebook; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="pass_db" class="col-sm-4 col-form-label col-form-label-sm">Password Base de Datos Almacén</label>
                                            <div class="col-sm-6">
                                                 <input type="password" class="form-control form-control-sm" id="pass_db" placeholder="Ingrese password" autocomplete="off" value = "<?php echo $config->pass_db_notebook; ?>">
                                            </div>
                                        </div>
                                 </div>

                                 <div class="col-md-6 col-sm-12 col-12 ">

                                     <div class="form-group row">
                                            <label for="host_db" class="col-sm-4 col-form-label col-form-label-sm">IP/Host Base de Datos Almacén</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="host_db" placeholder="Ingrese host" value = "<?php echo $config->host_db_notebook; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name_db" class="col-sm-4 col-form-label col-form-label-sm">Nombre Base de Datos Almacén</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="name_db" placeholder="Ingrese name" value = "<?php echo $config->name_db_notebook; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="port_db" class="col-sm-4 col-form-label col-form-label-sm">Puerto Base de Datos Almacén</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="port_db" placeholder="Ingrese puerto" value = "<?php echo $config->port_db_notebook; ?>">
                                            </div>
                                        </div>

                                </div>
                         </div>

                         <div class="col-md-12 col-sm-12 col-12 my-4">
                              <button class = "btn my-btn-blue float-right" onclick="updateConfigNotebook();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                         </div>
                    </div>




                                        <div class="invoi">
                         <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                      <h5><i class="fa fa-store"></i> Configuración general para tiendas </h5>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                         <div class="form-group row">
                                            <label for="points_for_money" class="col-sm-4 col-form-label col-form-label-sm">Puntos por cada $1.00</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="points_for_money" placeholder="Ingrese puntos" autocomplete="off" value = "<?php echo $config->points_for_money; ?>">
                                            </div>
                                        </div>
                                 </div>

                                 <div class="col-md-6 col-sm-12 col-12 ">
                                         <div class="form-group row">
                                            <label for="points_percentage" class="col-sm-4 col-form-label col-form-label-sm">Pesos equivalentes a 1 punto</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control form-control-sm" id="points_percentage" placeholder="Ingrese puntos" autocomplete="off" value = "<?php echo $config->points_percentage; ?>">
                                            </div>
                                        </div>
                                </div>
                         </div>

                         <div class="col-md-12 col-sm-12 col-12 my-4">
                              <button class = "btn my-btn-blue float-right" onclick="updateStoreConfig();" style="width:250px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                         </div>
                    </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/settings/config.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

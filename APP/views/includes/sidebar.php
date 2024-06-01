<?php
    $permisos = json_decode($_SESSION["datauser"]["permissions"]);
?>

<nav id="sidebar">
            <div class="sidebar-header">
                    <img src="<?php echo PATH; ?>/img/engine_white.png" width="35px"> &nbsp;<b>ADMIN CONSOLE</b>
            </div>
            <ul class="list-unstyled components">
                <li>
                          <a href="<?php echo PATH; ?>dashboard/"><i class="fa fa fa-desktop fa-lg"></i> Inicio</a>
                </li>

                <li>
                    <a href="#versionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-receipt"></i> Versionamiento</a>
                    <ul class="collapse list-unstyled" id="versionSubmenu">

                    <?php if($permisos->Versionamiento->Listado_de_Versiones->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>version/all/">Listado de Versiones</a>
                              </li>
                    <?php } if($permisos->Versionamiento->Version_en_Tiendas->Consultar == 1) { ?>
                            <li>
                              <a href="<?php echo PATH; ?>version/stores/">Versiones en Tiendas</a>
                            </li>
                    <?php } ?>
                    </ul>
                </li>

                <li>
                    <a href="#catalogSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-tasks fa-lg"></i> Catálogos</a>
                    <ul class="collapse list-unstyled" id="catalogSubmenu">

                    <?php if($permisos->Catalogos->Sucursales->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>store/list/">Sucursales</a>
                              </li>
                      <?php } if($permisos->Catalogos->Tarjeta_Puntos->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>card/list/">Tarjeta Puntos</a>
                              </li>
                      <?php } if($permisos->Catalogos->Articulos->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>items/list/">Artículos</a>
                              </li>
                      <?php } if($permisos->Catalogos->Productos_para_Canje->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>itemsChange/list/">Productos para Canje</a>
                              </li>
                      <?php } if($permisos->Catalogos->Clientes->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>customers/list/">Clientes</a>
                              </li>
                      <?php }if($permisos->Catalogos->Promociones->Consultar == 1) { ?>
                              <li>
                                <a href="<?php echo PATH; ?>promociones/list/">Promociones</a>
                              </li>
                      <?php }
                    ?>

                            <li>
                              <a href="<?php echo PATH; ?>catalog/all/">Ver más...</a>
                            </li>
                      <!--
                          <li>
                                <a href="#">Empleados</a>
                              </li>
                              <li>
                                <a href="#">Lineas</a>
                              </li>
                              <li>
                                <a href="#">Capacidades</a>
                              </li>
                              <li>
                                <a href="#">Códigos Blanco Igualado</a>
                              </li>
                              <li>
                                <a href="#">Proveedores</a>
                              </li>-->
                    </ul>
                </li>

                <li>
                    <a href="#libretaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-invoice-dollar"></i> Libreta de Pagos</a>
                    <ul class="collapse list-unstyled" id="libretaSubmenu">
                        <?php if($permisos->Libreta_de_Pagos->Listado_de_Facturas->Consultar == 1) { ?>
                             <li>
                                <a href="<?php echo PATH; ?>invoice/list/">Listado de Facturas</a>
                              </li>
                      <?php } ?>
                    </ul>
                </li>

                 <li>
                    <a href="#asistenciaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-clock"></i> Asistencia</a>
                    <ul class="collapse list-unstyled" id="asistenciaSubmenu">
                      <?php if($permisos->Asistencia->Empleados->Consultar == 1) { ?>
                            <li>
                              <a href="<?php echo PATH; ?>empleado/all/">Empleados</a>
                            </li>
                      <?php } if($permisos->Asistencia->Listado_de_Asistencia->Consultar == 1) { ?>
                            <li>
                              <a href="<?php echo PATH; ?>asistencia/bitacora/">Reporte de Asistencia</a>
                            </li>
                      <?php } if($permisos->Asistencia->Listado_de_Asistencia_Supervisor->Consultar == 1) { ?>
                            <li>
                              <a href="<?php echo PATH; ?>asistencia/bitacoraSuper/">Reporte de Asistencia Supervisores</a>
                            </li>
                      <?php } if($permisos->Asistencia->Listado_de_Retardos->Consultar == 1) { ?>
                            <li>
                              <a href="<?php echo PATH; ?>asistencia/bitacoraGlobal/">Listado de Retardos</a>
                            </li>
                      <?php }  ?>
                    </ul>
                </li>


                <li>
                   <a href="#toolSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-tools"></i> Herramientas</a>
                   <ul class="collapse list-unstyled" id="toolSubmenu">
                      <?php if($permisos->Herramientas->Pedidos_y_Vales->Consultar == 1) { ?>
                      <!---    <li>
                           <a href="#">Pedidos y Vales de Traspaso</a>
                         </li>
                   <li>
                           <a href="#">Pedidos en el Servidor</a>
                         </li>
                         <li>
                           <a href="#">Archivo de Precios</a>
                         </li> -->
                       <?php } if($permisos->Herramientas->Archivo_de_Precios->Editar == 1) { ?>
                             <li>
                               <a href="<?php echo PATH; ?>settings/upload_items/">Archivo de Precios</a>
                             </li>
                      <?php } if($permisos->Herramientas->Respaldo_de_Sucursales->Consultar == 1) { ?>

                          <li>
                            <a href="<?php echo PATH; ?>settings/backup_stores/">Respaldo de Sucursales</a>
                          </li>

                        <?php } if($permisos->Herramientas->Estructura_de_DB_Tiendas->Consultar == 1) { ?>

                          <li>
                            <a href="<?php echo PATH; ?>settings/db_structure/">Estructura de db en tiendas</a>
                          </li>

                      <?php } if($permisos->Herramientas->Dias_Inhabiles->Crear == 1) { ?>
                          <li>
                            <a href="<?php echo PATH; ?>settings/non_working/">Días inhábiles</a>
                          </li>
                      <?php } ?>
                   </ul>
               </li>


            <li>
              <a href="#gestionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-tasks"></i> Gestión</a>
                 <ul class="collapse list-unstyled" id="gestionSubmenu">
                 <?php if($permisos->Gestion->Transferencias_bancarias->Consultar == 1) { ?>
                    <li>
                      <a href="<?php echo PATH; ?>banktransfer/">Transferencias</a>
                    </li>
                  <?php } if($permisos->Gestion->Listado_de_cambio_de_precios->Consultar == 1) {?>
                    <li>
                        <a href="<?php echo PATH; ?>prices/all/">Lista de Cambio de Precios</a>
                    </li>
                  <?php  } ?>
                 </ul>

             </li>
              <li>
                 <a href="#configSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cogs"></i> Configuración</a>
                 <ul class="collapse list-unstyled" id="configSubmenu">

                   <?php if($permisos->Configuracion->Sistema->Crear == 1) { ?>
                       <li>
                           <a href="<?php echo PATH; ?>settings/system/">Sistema</a>
                       </li>

                  <?php } if($permisos->Configuracion->Usuarios->Consultar == 1) { ?>
                       <li>
                           <a href="<?php echo PATH; ?>settings/user/">Usuarios</a>
                       </li>
                  <?php } ?>
                 </ul>
             </li>

            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="<?php echo PATH; ?>login/close/" class = "article"><i class="fas fa-toggle-off"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </nav>

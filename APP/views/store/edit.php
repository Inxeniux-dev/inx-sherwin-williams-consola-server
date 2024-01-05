<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Editar Sucursal</title>
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
                               <h5 class ="text-primary"><i class="fas fa-info-circle"></i> Editar de Sucursal</h5>
                            </div>
                        </div>
                    </div>

                        <?php

                          if($data["store"])
                          {
                              $store = $data["store"]->fetch_object();
                          }

                        ?>

                        <div class="invoi invoi-blue">
                            <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive  mt-3">
                                                <table class="table  table-sm">
                                                    <tbody>
                                                      <tr>
                                                          <td class="text-blanco spacing">Sucursal :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo addCeros($store->idsucursal)."-".$store->nombre; ?></b></td>
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
                                                          <td class="text-blanco spacing">Serie :</td>
                                                          <td class="text-blanco spacing" align = "right"><b><?php echo $store->serie; ?></b></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                            </div>
                        </div>

                        <?php
                            if( $store->status == 0)
                            {
                                echo '<div class="invoi">
                                         <div class="row">
                                              <div class = "col-md-12">
                                                  <div class = "alert alert-warning">
                                                      <h5>La sucursal está desactivada, <b>¡No podrá ser visible en el Punto de Venta!</b></h5>
                                                  </div>
                                              </div>
                                         </div>
                                     </div>';
                            }
                        ?>



                        <div class="invoi">
                             <div class="row">
                                     <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                          <h5><i class="fas fa-pen"></i> Editar Información</h5>
                                     </div>
                                     <div class="col-md-6 col-sm-12 col-12 ">

                                        <input type="hidden" id = "idsucursal" value="<?php echo $store->idsucursal?>">

                                         <div class="form-group row">
                                             <label for="clave" class="col-sm-2 col-form-label col-form-label-sm">Clave</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo addCeros($store->idsucursal); ?>' id="clave" name="clave" placeholder="Ingrese clave">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="nombre" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->nombre; ?>' id="nombre" name="nombre" placeholder="Ingrese nombre">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="serie" class="col-sm-2 col-form-label col-form-label-sm">Serie</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->serie; ?>' id="serie" name="serie" placeholder="Ingrese serie">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="telefono" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->telefono; ?>' id="telefono" name="telefono" placeholder="Ingrese telefono">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="correo" class="col-sm-2 col-form-label col-form-label-sm">Correo</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->email; ?>' id="correo" name="correo" placeholder="Ingrese correo">
                                             </div>
                                         </div>
                                     </div>

                                     <div class="col-md-6 col-sm-12 col-12 ">

                                       <div class="form-group row">
                                           <label for="direccion" class="col-sm-2 col-form-label col-form-label-sm">Calle</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->direccion; ?>' id="direccion" name="direccion" placeholder="Ingrese calle">
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="cruzamiento" class="col-sm-2 col-form-label col-form-label-sm">Cruzamiento</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->cruzamiento; ?>' id="cruzamiento" name="cruzamiento" placeholder="Ingrese cruzamiento">
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="no_interior" class="col-sm-2 col-form-label col-form-label-sm">No. Interior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->num_interior; ?>' id="no_interior" name="no_interior" placeholder="Ingrese número">
                                           </div>

                                           <label for="no_exterior" class="col-sm-2 col-form-label col-form-label-sm">No. Exterior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->num_exterior; ?>' id="no_exterior" name="no_exterior" placeholder="Ingrese número">
                                           </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="colonia" class="col-sm-2 col-form-label col-form-label-sm">Colonia</label>
                                         <div class="col-sm-10">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->colonia; ?>' id="colonia" name="colonia" placeholder="Ingrese colonia">
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="cp" class="col-sm-2 col-form-label col-form-label-sm">Código Postal</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->cp; ?>' id="cp" name="cp" placeholder="Ingrese CP">
                                         </div>

                                         <label for="municipio" class="col-sm-2 col-form-label col-form-label-sm">Municipio</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->ciudad; ?>' id="municipio" name="municipio" placeholder="Ingrese municipio">
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="estado" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->estado; ?>' id="estado" name="estado" placeholder="Ingrese estado">
                                         </div>

                                         <label for="pais" class="col-sm-2 col-form-label col-form-label-sm">País</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->pais; ?>' id="pais" name="pais" placeholder="Ingrese pais">
                                         </div>
                                       </div>
                                     </div>

                                     <div class="col-md-6 col-sm-12 col-12 ">
                                       <div class="form-group row">
                                            <label for="foranea" class="col-sm-4 col-form-label col-form-label-sm hand"><b>¿Es Foránea?</b></label>
                                            <div class="col-sm-8">
                                            <div class="form-check">
                                            <input class="form-check-input hand" type="checkbox" value="" id="foranea" <?php echo $store->es_foranea == 1 ? "checked" : ""; ?> >
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                             <label for="sunday" class="col-sm-4 col-form-label col-form-label-sm hand"><b>¿Trabaja en Domingo?</b></label>
                                             <div class="col-sm-8">
                                             <div class="form-check">
                                             <input class="form-check-input hand" type="checkbox" value="" id="sunday" <?php echo $store->trabaja_domingo == 1 ? "checked" : ""; ?>>
                                             </div>
                                             </div>
                                         </div>

                                       <div class="form-group row">
                                            <label for="activo" class="col-sm-4 col-form-label col-form-label-sm hand"><b>Desactivar Sucursal</b></label>
                                            <div class="col-sm-8">
                                            <div class="form-check">
                                            <input class="form-check-input hand" type="checkbox" value="" id="activo" <?php echo $store->status == 0 ? "checked" : ""; ?>>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                             <div class = "row mt-4">
                                 <div class="col-md-6 col-sm-12 col-12 ">
                                   <div class="form-group row">
                                       <label for="ip" class="col-sm-2 col-form-label col-form-label-sm">Ip Hamachi</label>
                                       <div class="col-sm-10">
                                       <input type="text" class="form-control form-control-sm" value='<?php echo $store->ip; ?>' id="ip" name="ip" placeholder="Ingrese ip">
                                       </div>
                                   </div>
                                </div>
                             </div>
                        </div>


                        <div class="invoi">
                             <div class="row">
                               <div class="col-md-12 col-sm-12 col-12 ">
                                   <button class = "btn my-btn-blue float-right" onclick="update();"><i class="fas fa-save"></i> Actualizar Información</button>
                               </div>
                                </div>
                          </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/store/edit.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

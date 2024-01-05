<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Detalle Sucursal</title>
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
                               <h5 class ="text-primary"><i class="fas fa-info-circle"></i> Detalle de Sucursal</h5>
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



                        <div class="invoi">
                             <div class="row">
                                     <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                          <h5>Información</h5>
                                     </div>
                                     <div class="col-md-6 col-sm-12 col-12 ">

                                         <div class="form-group row">
                                             <label for="clave" class="col-sm-2 col-form-label col-form-label-sm">Clave</label>
                                             <div class="col-sm-10">
                                               <input type="text" class="form-control form-control-sm" value='<?php echo addCeros($store->idsucursal); ?>' readonly>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="nombre" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->nombre; ?>' readonly>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="serie" class="col-sm-2 col-form-label col-form-label-sm">Serie</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->serie; ?>' readonly>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="telefono" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->telefono; ?>' readonly>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="correo" class="col-sm-2 col-form-label col-form-label-sm">Correo</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" value='<?php echo $store->email; ?>' readonly>
                                             </div>
                                         </div>

                                     </div>

                                     <div class="col-md-6 col-sm-12 col-12 ">

                                       <div class="form-group row">
                                           <label for="direccion" class="col-sm-2 col-form-label col-form-label-sm">Calle</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->direccion; ?>' readonly>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="cruzamiento" class="col-sm-2 col-form-label col-form-label-sm">Cruzamiento</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->cruzamiento; ?>' readonly>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="no_interior" class="col-sm-2 col-form-label col-form-label-sm">No. Interior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->num_interior; ?>'readonly>
                                           </div>

                                           <label for="no_exterior" class="col-sm-2 col-form-label col-form-label-sm">No. Exterior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->num_exterior; ?>' readonly>
                                           </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="colonia" class="col-sm-2 col-form-label col-form-label-sm">Colonia</label>
                                         <div class="col-sm-10">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->colonia; ?>' readonly>
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="cp" class="col-sm-2 col-form-label col-form-label-sm">Código Postal</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->cp; ?>' readonly>
                                         </div>

                                         <label for="municipio" class="col-sm-2 col-form-label col-form-label-sm">Municipio</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->ciudad; ?>' readonly>
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="estado" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->estado; ?>' readonly>
                                         </div>

                                         <label for="pais" class="col-sm-2 col-form-label col-form-label-sm">País</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" value='<?php echo $store->pais; ?>' readonly>
                                         </div>
                                       </div>

                                     </div>
                             </div>
                        </div>

                          <div class="invoi">
                               <div class="row">
                                       <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                            <h5>Información de Configuración</h5>
                                       </div>
                                       <div class="col-md-6 col-sm-12 col-12 ">

                                       <div class="form-group row">
                                           <label for="clave" class="col-sm-2 col-form-label col-form-label-sm">Ip Hamachi</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" value='<?php echo $store->ip; ?>' readonly>
                                           </div>
                                       </div>

                                       </div>
                               </div>
                          </div>



                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/store/detail.js"></script>
</body>
</html>

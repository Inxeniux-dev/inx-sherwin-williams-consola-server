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


                    <div class="invoi invoi-blue">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-blanco"><i class="fas fa-info-circle"></i> Detalle de Sucursal</h5>
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
                                               <input type="text" class="form-control form-control-sm" id = "clave">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="nombre" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" id = "nombre">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="serie" class="col-sm-2 col-form-label col-form-label-sm">Serie</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" id = "serie">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="telefono" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" id = "telefono">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="correo" class="col-sm-2 col-form-label col-form-label-sm">Correo</label>
                                             <div class="col-sm-10">
                                             <input type="text" class="form-control form-control-sm" id = "correo">
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <label for="tipo" class="col-sm-2 col-form-label col-form-label-sm">Tipo</label>
                                             <div class="col-sm-5">
                                                <select class="form-control form-control-sm" id = "tipo">
                                                    <option value = "0">Tienda</option>
                                                    <option value = "1">Almacén</option>
                                                    <option value = "3">Auditoria</option>
                                                </select>
                                             </div>
                                         </div>

                                     </div>

                                     <div class="col-md-6 col-sm-12 col-12 ">

                                       <div class="form-group row">
                                           <label for="direccion" class="col-sm-2 col-form-label col-form-label-sm">Calle</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" id = "direccion">
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="cruzamiento" class="col-sm-2 col-form-label col-form-label-sm">Cruzamiento</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" id = "cruzamiento">
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="no_interior" class="col-sm-2 col-form-label col-form-label-sm">No. Interior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" id = "no_interior">
                                           </div>

                                           <label for="no_exterior" class="col-sm-2 col-form-label col-form-label-sm">No. Exterior</label>
                                           <div class="col-sm-4">
                                           <input type="text" class="form-control form-control-sm" id = "no_exterior">
                                           </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="colonia" class="col-sm-2 col-form-label col-form-label-sm">Colonia</label>
                                         <div class="col-sm-10">
                                         <input type="text" class="form-control form-control-sm" id = "colonia">
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="cp" class="col-sm-2 col-form-label col-form-label-sm">Código Postal</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" id = "cp">
                                         </div>

                                         <label for="municipio" class="col-sm-2 col-form-label col-form-label-sm">Municipio</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" id = "municipio">
                                         </div>
                                       </div>


                                       <div class="form-group row">
                                         <label for="estado" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" id = "estado">
                                         </div>

                                         <label for="pais" class="col-sm-2 col-form-label col-form-label-sm">País</label>
                                         <div class="col-sm-4">
                                         <input type="text" class="form-control form-control-sm" id = "pais">
                                         </div>
                                       </div>

                                     </div>


                                     <div class="col-md-6 col-sm-12 col-12 mt-4">
                                       <div class="form-group row">
                                            <label for="foranea" class="col-sm-4 col-form-label col-form-label-sm hand"><b>¿Es Foránea?</b></label>
                                            <div class="col-sm-8">
                                            <div class="form-check">
                                            <input class="form-check-input hand" type="checkbox" value="" id="foranea">
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                             <label for="sunday" class="col-sm-4 col-form-label col-form-label-sm hand"><b>¿Trabaja en Domingo?</b></label>
                                             <div class="col-sm-8">
                                             <div class="form-check">
                                             <input class="form-check-input hand" type="checkbox" value="" id="sunday">
                                             </div>
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
                                           <label for="ip" class="col-sm-2 col-form-label col-form-label-sm">Ip Hamachi</label>
                                           <div class="col-sm-10">
                                           <input type="text" class="form-control form-control-sm" id="ip">
                                           </div>
                                       </div>

                                       </div>
                               </div>
                          </div>

                          <div class="invoi">
                               <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12 ">
                                     <button class = "btn my-btn-blue float-right" onclick="add();"><i class="fas fa-save"></i> Registrar Información</button>
                                 </div>
                                  </div>
                            </div>



                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/store/add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi  invoi-blue">
                        <div class="row">
                          <div class="col-sm-12">
                               <h5 class ="text-blanco">Cargar Artchivo de Artículos</h5>
                            </div>
                        </div>
                    </div>

                        <div class="invoi">
                          <div class="row">
                            <div class="col-sm-12">
                                <div class = "alert alert-info">
                                      Este proceso cargará el fichero seleccionado y se eliminarán los registros de la base de datos de articulos.
                                </div>
                            </div>
                          </div>
                       </div>


                       <div class="invoi  invoi-blue">
                           <div class="row">
                             <div class="col-sm-12" style="text-align:center;">
                                         <br><br>
                                         <h3>Ejemplo de la estructura del archivo a subir</h3><br>
                                         <h5>La primera fila será ignorada</h5><br>
                                         <h5>Todas las columnas deben de estar en formato Texto</h5><br>
                                         <img src="<?php echo PATH; ?>/img/excel_items.jpg" width="85%"/>
                                         <br><br><br>
                               </div>
                           </div>
                       </div>


                       <div class="invoi">
                         <div class="row">
                           <div class="col-sm-12">
                             <form method="post" action="#" enctype="multipart/form-data">
                                 <div class="card">
                                     <div class="card-body">
                                         <h5 class="card-title">Sube el archivo en formato Excel</h5>
                                         <div class="form-group">
                                             <label for="image">Cargar archivo</label>
                                             <input type="file" class="form-control-file" name="image" id="image">
                                         </div>
                                          <input type="button" class="btn my-btn-blue upload" value="Cargar Archivo" style="width:250px;">
                                     </div>
                                 </div>
                              </form>
                           </div>
                         </div>
                      </div>


                      <div class="invoi d-none d-client" id ="dt-client">
                        <div class="table-responsive table-client">

                        </div>
                     </div>

                     <div class="invoi d-none d-client">
                       <div class="row">
                         <div class="col-sm-12">
                            <button class = "btn my-btn-blue float-left confirm" style = "width:250px;"><i class="fas fa-check-circle"></i> Confirmar</button>
                         </div>
                       </div>
                    </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/settings/upload_items.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

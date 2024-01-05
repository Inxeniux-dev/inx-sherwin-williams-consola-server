<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Location Detail</title>
  </head>
  <body>
  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">
        
        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">
                        
                        <div class="invoi" style ="margin-bottom: 1px;">  

                            <div class="row">
                                <div class="col-sm-8 col-12 ">
                                        <i class="fa fa-home"></i> Detalles de  <span class="text-primary"><b><?php  echo strtoupper($data->nombre); ?></b></span>
                                </div>
                                <div class="col-sm-4 col-12" style="text-align: right;">
                                        <a href="../../add/" class="btn btn-success btn-sm "><i class="fa fa-home"></i> Nueva sucursal</a> 
                                            
                                        <a href="../../add/<?php echo $data->idsucursal; ?>/" class="btn btn-primary btn-sm "><i class="fa fa-home"></i> Editar sucursal</a>
                                </div>
                            </div>
                        </div> <!-- end invoi-->

                        <div class="invoi" style ="margin-bottom: 1px;">  
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                       
                                        <div class="col-md-12 col-12 box-items">                        
                                            <div class="box-items">

                                                    <strong><i class="fas fa-key margin-r-5"></i> Clave</strong>
                                                    <p class="text-muted"><?php echo $data->idsucursal; ?></p>
                                                    <hr>

                                                    <strong><i class="fas fa-ad margin-r-5"></i></i> Serie</strong>
                                                    <p class="text-muted"><?php echo strtoupper($data->serie); ?></p>
                                                    <hr>

                                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
                                                    <p class="text-muted"><?php echo strtoupper($data->direccion." Int ".$data->num_interior.", Ext ".$data->num_exterior.", ".$data->colonia.", ".$data->ciudad.", ".$data->estado.", ".$data->pais); ?></p>
                                                    <hr>

                                                    <strong><i class="fa fa-home margin-r-5"></i> Tipo de sucursal</strong>
                                                    <p class="text-muted"><?php if ($data->tipo == 1) { echo 'Tienda'; } if ($data->tipo == 2) { echo 'Almacén'; } if ($data->tipo == 3) { echo 'Auditoria'; } ?></p>
                                                    <hr>
                                                
                                            </div>                      
                                        </div>
                                </div>
                            </div>
                        </div> <!-- end invoi-->


                        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>


                     </div> <!-- end row-->
                     
                </div> <!-- end container fluid-->
            
            </div>  

        </div>
        

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>  

    <script>
        $(document).ready(function(){
            $("#sidebarCollapse").on('click', function(){
                $("#sidebar").toggleClass("active");
            });
        });
    </script>


</body>
</html>
<!doctype html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel = "icon"  href="<?php echo PATH; ?>../public/img/paint.ico">
    <link rel="stylesheet" href="<?php echo PATH; ?>../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>../public/css/style.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>../public/css/quicksand.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>../public/css/all.min.css">
    <script src ="<?php echo PATH; ?>../public/js/app/sweetalert2.min.js"></script>

    <title> <?php  if(!$data->edit) { echo 'Nueva sucursal'; } else { "Editar sucursal"; }?></title>
  </head>
  <body>
    
  <div class="wrapper">
        <div class="content">
              <div class="container-fluid ">
                    <div class="row">
                        
                        <div class="invoi" style ="margin-bottom: 1px;">  
                            <div class="row">
                                <div class="col-sm-12 col-12 " style = "text-align : center; padding-top: 40px; padding-bottom: 40px;">
                                   <?php 

                                    if($data["error"] == 1)
                                    {
                                        echo " 
                                            <span class = 'text-danger'>
                                                <i class = 'fa fa-exclamation-triangle' title = 'Información del error' style = 'cursor : pointer; '></i>
                                                     El sistema no puede funcionar debido a que se <b> detectaron archivos inusuales que impiden el funcionamiento. </b></b>
                                            </span> 
                                            
                                            <br><br>
                                            
                                            <span class = 'text-danger' >
                                                 <i class = 'fa fa-question-circle-o' title = 'Sugerencia' style = 'cursor : pointer; '></i> 
                                                 Verifica con el departamento de informática. 

                                                 </span> 
                                            ";
                                    }

                                    if($data["error"] == 2)
                                    {
                                        echo " 
                                            <span class = 'text-danger'>
                                                <i class = 'fa fa-exclamation-triangle' title = 'Información del error' style = 'cursor : pointer; '></i>
                                                     El sistema no puede funcionar debido a que se <b> detectaron archivos inusuales que impiden el funcionamiento. </b></b>
                                            </span> 
                                            
                                            <br><br>
                                            
                                            <span class = 'text-danger' >
                                                 <i class = 'fa fa-question-circle-o' title = 'Sugerencia' style = 'cursor : pointer; '></i> 
                                                    No es posible agregar la venta

                                                 </span> 
                                            ";
                                    }
                                   
                                   ?>
                                </div>
                            </div>
                        </div>

                    </div>  <!--- end row -->

            </div>  <!--- end container-fluid -->

        </div>  <!--- end content -->
    </div> <!--- end wrapper -->


    <?php if($data->edit) {  echo "<script>var edit = true; var il = ".$data->idsucursales.";</script>"; } else{ echo "<script> var edit = false; var il = null; </script>"; } ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#sidebarCollapse").on('click', function(){
                $("#sidebar").toggleClass("active");
            });

          //  $('.dropdown-toggle').dropdown();
        });
    
    </script>


</body>
</html>
<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items</title>
  </head>
  <body>

  <div class="wrapper">

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">
                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-12">
                               <div class ="alert alert-danger">
                                    <h4><i class="fas fa-exclamation-triangle"></i> <b>EL SISTEMA NO ESTA ACTUALIZADO CORRECTAMENTE</b></h4>
                                    <label><b>Se han detectado anomalías al actualizar el sistema</b></label>
                                    <br>
                                    Versión de Sistema: <b><?php echo VERSION; ?></b><br>
                                    Versión en Base de Datos: <b><?php echo $data["version"]; ?></b>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                               <div class ="alert alert-info">
                                    <h4><i class="fas fa-question-circle"></i> Realiza lo siguiente: </h4>
                                    <label><b>1) Intenta actualizar el sistema nuevamente en el programa de utilerias</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>

<script>
    $(document).ready(function(){
          $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
      });
</script>
</body>
</html>

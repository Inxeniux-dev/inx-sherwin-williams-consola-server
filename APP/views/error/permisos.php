<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Listado de depósitos</title>
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
                                  <div class="col-12">
                                       <div class = "alert alert-warning"><i class="fas fa-user-lock"></i>  <b> ¡No tienes acceso a esta función! </b> Pregunta con el administrador del sistema.</div>
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

    });

</script>


</body>
</html>
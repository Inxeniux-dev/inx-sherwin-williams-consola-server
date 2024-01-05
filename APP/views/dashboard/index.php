<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Dashboard</title>
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
                          <div class="col-sm-12">
                               <h5 class ="text-blanco"><i class="fas fa-tachometer-alt"></i> Dashboard</h5>
                            </div>
                        </div>
                    </div>


                        <div class="invoi">
                          <div class="row">
                            <div class="col-sm-12">
                                <h4 class = 'text-primary'>Bienvenido <b>¡<?php echo strtoupper($_SESSION["datauser"]["name"]); ?>!</b></h4><br>
                              </div>
                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php echo "<script>  +function (w, d, undefined) {  w.localStorage.removeItem('appID'); } (window, document); </script>";?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/dashboard/init.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

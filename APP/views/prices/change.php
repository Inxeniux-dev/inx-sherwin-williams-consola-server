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


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary"><b><i class="fas fa-tags"></i> Cambio de precios </b></h5>
                            </div>
                            <div class="col-sm-4 col-12">    
                            </div>
                        </div>
                    </div>



                        <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive  mt-3">
                                            <table class="table  table-sm">
                                                <tbody>
                                                <tr>
                                                    <td class="text-blanco spacing">Fecha de operación :</td>
                                                    <td class="text-blanco spacing" align = "right"><b><?php echo $_SESSION["config"]["date_corte"]?></b></td>
                                                </tr>
                                            </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive  mt-3">
                                            <table class="table  table-sm">
                                                <tbody>
                                                <tr>
                                                    <td class="text-blanco spacing">Consultar Información :</td>
                                                    <td class="text-blanco spacing" align = "right"><button class = "btn my-btn-blanco btn-sm btn-search"><i class="fas fa-search"></i> <i class="fas fa-server"></i> Consultar</button></td>
                                                </tr>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="invoi">
                          <div class="table-responsive table-prices" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>



    <?php echo "<script> var api_url = '".$_SESSION["config"]["api_url"]."prices'; </script>" ?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/prices/change.js">

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>

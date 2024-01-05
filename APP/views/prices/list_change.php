<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Prices List</title>
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
                               <h5 class ="text-primary">Historial de Cambio de Precios</h5>
                            </div>
                        </div>
                    </div>



                    <div class="invoi invoi-blue">
                        <div class="row">
                          <div class="col-sm-10 col-12 ">
                              <div class="form-row">
                                   <div class="col-3">
                                        <label for="fechainicial">Fecha Inicial</label>
                                        <input type = "date" class="form-control form-control-sm" id="fechini" value = '<?php echo inicio_de_mes(date("Y-m-d"));?>' />
                                    </div>
                                    <div class="col-3">
                                         <label for="fechafinal">Fecha Final</label>
                                         <input type = "date" class="form-control form-control-sm" id="fechfin" value = '<?php echo date("Y-m-d");?>' />
                                   </div>
                                   <div class="col-3">
                                       <button class="btn my-btn-blanco btn-sm btn-block btn-search" style = 'margin-top:30px; ' id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                   </div>
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


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/prices/list.js?v=<?php echo rand(); ?>"></script>
</body>
</html>

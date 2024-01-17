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
                          <div class="col-sm-12">
                               <h5 class ="text-primary">Búsqueda de existencias</h5>
                            </div>
                        </div>
                    </div>



                        <div class="invoi invoi-blue">
                            <div class="row">
                              <div class="col-sm-12 col-12 ">
                                  <div class="form-row">
                                      <div class="col-4">
                                          <label for="code"><b>Código </b></label>
                                          <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Ingresar código" />
                                      </div>
                                      <div class="col-4">
                                          <button class="btn my-btn-blue-border btn-sm" id="btn-search" style = "margin-top: 30px; width:250px;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search"></i> Buscar</button>
                                      </div>

                                  </div>
                              </div>

                            </div>
                        </div>




                        <div class="invoi">
                          <div class="table-responsive table-codes" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/search_server.js"></script>
</body>
</html>

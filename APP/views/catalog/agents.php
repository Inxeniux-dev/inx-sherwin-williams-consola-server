<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Line</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">


                      <div class="invoi invoi-blue" style ="margin-bottom: 1px;">
                              <div class="row">
                                  <div class="col-sm-8 col-12 ">
                                      <div class="form-row">
                                          <div class="col">
                                              <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Buscar Agente" />
                                          </div>
                                          <div class="col">
                                              <button class="btn my-btn-blanco btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-4 col-12">
                                      <button class="btn my-btn-blue-border float-right btn-sync  btn-sm"><i class="fas fa-sync-alt"></i> Sincronizar</button>
                                  </div>
                              </div>
                      </div>

                        <div class="invoi">
                          <div class="table-responsive table-lines" style='min-height: 50px;'>

                          </div>
                       </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/agent/list.js"></script>

</body>
</html>

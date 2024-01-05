<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Catálogo</title>
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
                               <h5 class ="text-blanco">Catálogos</h5>
                            </div>
                        </div>
                    </div>



                    <div class="invoi">
                        <div class="row">
                              <div class="col-md-4 col-sm-12 col-4 ">
                                  <div class="row">
                                      <a href= "../../mark/" style="width: 100%;">
                                        <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                            <h5><i class="fa fa-list"></i> Marca</h5>
                                        </div>
                                      </a>
                                  </div>
                              </div>

                               <div class="col-md-4 col-sm-12 col-4 ">
                                  <div class="row">
                                    <a href= "../../line/" style="width: 100%;">
                                        <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                            <h5><i class="fa fa-list"></i> Líneas</h5>
                                        </div>
                                    </a>
                                  </div>
                              </div>

                              <div class="col-md-4 col-sm-12 col-4 ">
                                 <div class="row">
                                   <a href= "../../capacity/" style="width: 100%;">
                                       <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                           <h5><i class="fa fa-list"></i> Capacidades</h5>
                                       </div>
                                   </a>
                                 </div>
                             </div>

                              <div class="col-md-4 col-sm-12 col-4 ">
                                 <div class="row">
                                   <a href= "../../supplier/" style="width: 100%;">
                                       <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                           <h5><i class="fa fa-list"></i> Proveedores</h5>
                                       </div>
                                   </a>
                                 </div>
                             </div>

                             <div class="col-md-4 col-sm-12 col-4 ">
                                 <div class="row">
                                   <a href= "../../seller/" style="width: 100%;">
                                       <div class="col-11 hand" style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; margin:20px; padding: 20px;">
                                           <h5><i class="fa fa-list"></i> Vendedores</h5>
                                       </div>
                                   </a>
                                 </div>
                             </div>
                        </div>
                    </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list.js"></script>
</body>
</html>

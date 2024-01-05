<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Items Change</title>
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
                                <h5 class="text-primary"><i class="fas fa-gifts"></i> Listado de artículos para canje</h5>
                              </div>
                                <?php if($data["permisos"]->Crear) { ?>
                                    <div class="col-sm-4">
                                          <a href="../create/" class="btn my-btn-blue-light btn-sm float-right"><i class="fas fa-gifts"></i> Agregar Producto</a>
                                     </div>
                                <?php } ?>
                           </div>
                      </div>

                        <div class="invoi invoi-blue">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Buscar artículos" />
                                        </div>
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="type">
                                                <option value = "0">Todos</option>
                                                <option value = "1">Con existencias </option>
                                                <option value = "2">Sin existencias </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn my-btn-blue-border btn-sm" id="btn-search"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="invoi">
                              <div class="table-responsive table-items" style="min-height:200px;">
                              </div>
                        </div>

                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>


    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/items/list_change.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

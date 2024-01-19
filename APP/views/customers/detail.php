<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Detalle Cliente</title>
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
                          <div class="col-sm-8">
                               <h5 class ="text-blanco"><i class="fas fa-sitemap"></i> Detalle del cliente</h5>
                            </div>
                        </div>
                    </div>


                    <?php
                        $item = $data["item"]->fetch_object();
                    ?>


                  <div class="invoi">
                              <div class="row">

                                    <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Datos del cliente </h5>
                                      </div>

                                      <div class="col-md-6 col-sm-12 col-12 ">
                                        <div class="form-group row">
                                            <label for="rfc" class="col-sm-4 col-form-label col-form-label-sm">*RFC</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->RFC; ?>' readonly id="rfc" name="rfc" placeholder="Ingrese RFC" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="rfc_confirm" class="col-sm-4 col-form-label col-form-label-sm">*Confirmar RFC</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->RFC; ?>' readonly id="rfc_confirm" name="rfc_confirm" placeholder="Confirme RFC" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label col-form-label-sm">*Nombre</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->NOMBRE; ?>' readonly id="name" name="name" placeholder="Ingrese nombre" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lastname" class="col-sm-4 col-form-label col-form-label-sm">*Apellidos</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->APELLIDO; ?>' readonly id="lastname" name="lastname" placeholder="Ingrese apellido" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="razon" class="col-sm-4 col-form-label col-form-label-sm">*Razon Social</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->RAZON_SOCIAL; ?>' readonly id="razon" name="razon" placeholder="Ingrese razón social">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                            <div class="col-sm-8">
                                            <input type="email" class="form-control form-control-sm" value='<?php echo $item->EMAIL; ?>' readonly id="email" name="email" placeholder="Ingrese email" onchange="convMinusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="telefono" class="col-sm-4 col-form-label col-form-label-sm">Teléfono</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->TELEFONO; ?>' readonly id="telefono" name="telefono" placeholder="Ingrese teléfono">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="celular" class="col-sm-4 col-form-label col-form-label-sm">Celular</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->CELULAR; ?>' readonly id="celular" name="celular" placeholder="Ingrese celular">
                                            </div>
                                        </div>
                                      </div>

                                      <div class="col-md-6 col-sm-12 col-12 ">
                                        <div class="form-group row">
                                            <label for="direccion" class="col-sm-4 col-form-label col-form-label-sm">Dirección</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->DIRECCION; ?>' readonly id="direccion" name="direccion" placeholder="Ingrese dirección" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="colonia" class="col-sm-4 col-form-label col-form-label-sm">Colonia</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->COLONIA; ?>' readonly id="colonia" name="colonia" placeholder="Ingrese colonia" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="numexterior" class="col-sm-4 col-form-label col-form-label-sm">Número Exterior</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->NUM_EXTERIOR; ?>' readonly id="numexterior" name="numexterior" placeholder="Ingrese número exterior" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="numinterior" class="col-sm-4 col-form-label col-form-label-sm">Número Interior</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->NUM_INTERIOR; ?>' readonly id="numinterior" name="numinterior" placeholder="Ingrese número interior" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cp" class="col-sm-4 col-form-label col-form-label-sm">*Código Postal</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->CODIGO_POSTAL; ?>' readonly id="cp" name="cp" placeholder="Ingrese código postal">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="municipio" class="col-sm-4 col-form-label col-form-label-sm">*Municipio</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->MUNICIPIO; ?>' readonly id="municipio" name="municipio" placeholder="Ingrese municipio" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="estado" class="col-sm-4 col-form-label col-form-label-sm">*Estado</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->ESTADO; ?>' readonly id="estado" name="estado" placeholder="Ingrese estado" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="pais" class="col-sm-4 col-form-label col-form-label-sm">*País</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" value='<?php echo $item->PAIS; ?>' readonly id="pais" name="pais" placeholder="Ingrese país" onchange="convMayusculas(this);">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="regimen" class="col-sm-4 col-form-label col-form-label-sm">*Régimen Fiscal</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm" readonly id="regimen" name="regimen">
                                                    <?php
                                                        $regimen = $data["regimen"];
                                                        while ($row = $regimen->fetch_object()) {

                                                          if($row->idregimen == $item->id_regimen)
                                                          {
                                                              echo "<option value = '".$row->idregimen."' selected>".$row->clave."-".$row->descripcion."</option>";
                                                          }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
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
    <script>
    $(document).ready(() =>{
        $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass("active");
              $(".content").toggleClass("active");
        });
      });
    </script>
</body>
</html>

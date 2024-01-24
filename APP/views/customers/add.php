<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Crear Cliente</title>
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
                               <h5 class ="text-blanco"><i class="fas fa-user"></i> Crear cliente</h5>
                            </div>
                        </div>
                    </div>




                  <div class="invoi">
                        <div class="row">

                                      <div class="col-md-12 col-sm-12 col-12" style ="margin-bottom:20px;">
                                           <h5><i class="fas fa-info-circle"></i> Ingrese los datos del cliente </h5>
                                      </div>

                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="rfc" class="col-sm-4 col-form-label col-form-label-sm">*RFC</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="rfc" name="rfc" placeholder="Ingrese RFC" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="rfc_confirm" class="col-sm-4 col-form-label col-form-label-sm">*Confirmar RFC</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="rfc_confirm" name="rfc_confirm" placeholder="Confirme RFC" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="name" class="col-sm-4 col-form-label col-form-label-sm">*Nombre</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="name" name="name" placeholder="Ingrese nombre" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="lastname" class="col-sm-4 col-form-label col-form-label-sm">*Apellidos</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="lastname" name="lastname" placeholder="Ingrese apellido" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="razon" class="col-sm-4 col-form-label col-form-label-sm">*Razon Social</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="razon" name="razon" placeholder="Ingrese razón social">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="email" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                              <div class="col-sm-8">
                                              <input type="email" class="form-control form-control-sm" value='' id="email" name="email" placeholder="Ingrese email" onchange="convMinusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="telefono" class="col-sm-4 col-form-label col-form-label-sm">Teléfono</label>
                                              <div class="col-sm-8">
                                              <input type="tel" class="form-control form-control-sm" value='' id="telefono" name="telefono" placeholder="Ingrese teléfono">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="celular" class="col-sm-4 col-form-label col-form-label-sm">Celular</label>
                                              <div class="col-sm-8">
                                              <input type="tel" class="form-control form-control-sm" value='' id="celular" name="celular" placeholder="Ingrese celular">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-12 col-form-label col-form-label-sm text-danger">Los campos marcados con * (asterisco) son obligatorios.</label>
                                          </div>
                                      </div>

                                      <div class="col-md-6 col-sm-12 col-12 ">
                                          <div class="form-group row">
                                              <label for="direccion" class="col-sm-4 col-form-label col-form-label-sm">Dirección</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="direccion" name="direccion" placeholder="Ingrese dirección" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="colonia" class="col-sm-4 col-form-label col-form-label-sm">Colonia</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="colonia" name="colonia" placeholder="Ingrese colonia" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="numexterior" class="col-sm-4 col-form-label col-form-label-sm">Número Exterior</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="numexterior" name="numexterior" placeholder="Ingrese número exterior" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="numinterior" class="col-sm-4 col-form-label col-form-label-sm">Número Interior</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="numinterior" name="numinterior" placeholder="Ingrese número interior" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="cp" class="col-sm-4 col-form-label col-form-label-sm">*Código Postal</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="cp" name="cp" placeholder="Ingrese código postal">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="municipio" class="col-sm-4 col-form-label col-form-label-sm">*Municipio</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="municipio" name="municipio" placeholder="Ingrese municipio" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="estado" class="col-sm-4 col-form-label col-form-label-sm">*Estado</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="estado" name="estado" placeholder="Ingrese estado" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="pais" class="col-sm-4 col-form-label col-form-label-sm">*País</label>
                                              <div class="col-sm-8">
                                              <input type="text" class="form-control form-control-sm" value='' id="pais" name="pais" placeholder="Ingrese país" onchange="convMayusculas(this);">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="regimen" class="col-sm-4 col-form-label col-form-label-sm">*Régimen Fiscal</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control form-control-sm" value='' id="regimen" name="regimen">
                                                      <!-- <option value = "0"> Seleccione</option> -->
                                                      <?php
                                                          /*$regimen = $data["regimen"];
                                                          while ($row = $regimen->fetch_object()) {
                                                            echo "<option value = '".$row->idregimen."'>".$row->clave."-".$row->descripcion."</option>";
                                                          }*/
                                                      ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <button class = "btn my-btn-blue float-right btn-save my-5" style="width:250px;"><i class="fas fa-check-circle"></i> Registrar</button>
                                      </div>

                        </div>
                  </div>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

    <?php
       $fisica = [];
       $moral = [];

       $regimen = $data["regimen"];

        while($row = $regimen->fetch_object())
        {
            if($row->fisica == 1)
            {
                $fisica[] = ["id" => $row->idregimen, "clave" => $row->clave, "descripcion" => $row->descripcion];
            }
            if($row->moral == 1)
            {
                $moral[] = ["id" => $row->idregimen, "clave" => $row->clave, "descripcion" => $row->descripcion];
            }
        }
    ?>

    <script>
        let data_fisica = <?php echo json_encode($fisica);?>;
        let data_moral = <?php echo json_encode($moral);?>;
    </script>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/customers/add.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

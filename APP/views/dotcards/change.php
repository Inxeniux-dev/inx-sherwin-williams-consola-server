<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title>Point Change</title>
  </head>
  <body>

  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>

        <?php
            $KEY = $data["KEY"];
            $sync = $data["sync"];
            $data = $data["data"];
            $PUNTOS_POR_PESO = 4;


        ?>

              <div class="container-fluid ">
                    <div class="row">


                    <div class="invoi">
                        <div class="row">
                          <div class="col-sm-8">
                               <h5 class ="text-primary">Canje de Puntos</h5>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class = 'dropdown'>
                                      <button class = 'btn btn-primary dropdown-toggle dropdown-toggle-remove-row btn-sm float-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                                          <i class = 'fa fa-cog'></i> Opciones
                                      </button>
                                      <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                              <a href="../../" class = 'dropdown-item'><i class="fas fa-trash-alt"></i> Cancelar</a>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>



                        <div class="invoi invoi-blue">
                            <div class="row">

                                        <div class="col-sm-6 col-12 ">
                                             <div class="table-responsive  mt-3">
                                                    <table class="table  table-sm">
                                                        <input type = "hidden" value = "<?php echo $data->num_tarjeta;?>" id = "no_card">
                                                        <tbody id ="info">
                                                          <tr>
                                                              <td class="text-blanco spacing">No. Tarjeta :</td>
                                                              <td class="text-blanco spacing" align = "right"><?php echo $data->num_tarjeta; ?></td>
                                                          </tr>
                                                          <tr>
                                                              <td class="text-blanco spacing">Nombre del Titular :</td>
                                                              <td class="text-blanco spacing" align = "right"><?php echo $data->nombre; ?></td>
                                                          </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12 ">
                                             <div class="table-responsive  mt-3">
                                                    <table class="table  table-sm">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-blanco spacing">Puntos Acumulados :</td>
                                                            <td class="text-blanco spacing" align = "right"><?php echo number_format($data->puntos,0); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-blanco spacing">Ocupación :</td>
                                                            <td class="text-blanco spacing" align = "right"><?php echo $data->ocupacion; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                            </div>
                        </div>



                      <?php


                      if($sync){

                        $options = stream_context_create(array('http'=>
                            array(
                            'timeout' => TIMEOUT_SYNC_PRODUCT_SERVER
                            )
                        ));

                            $url = $_SESSION["config"]["api_url"]."pointcard/products.php?key=".API_KEY;
                            $datos = null;
                            if(@file_get_contents($url, false, $options)){
                                $json = file_get_contents($url);
                                $status_conection = true;
                                    if($json != null )
                                    {
                                        $datos = json_decode($json, true);
                                    }
                             }
                       ?>



                        <div class="invoi d-val">
                              <div class = "row">
                                    <div class="col-sm-12 col-12 ">
                                      <div class="form-row">
                                            <div class="form-group col-md-12">
                                                     <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> <span>Confirme con el <b>lector de huella</b> la identidad del pintor, después presione validar.</span></div>
                                             </div>

                                            <div class="form-group col-md-6">
                                               <blockquote class="blockquote" style="margin-top:50px; text-align:center;">
                                                    <b> Datos del pintor : </b>
                                                   <p class="mb-0"><?php echo $data->nombre; ?>  <small>(<?php echo $data->num_tarjeta; ?>)</small></p>
                                                   <footer class="blockquote-footer">En espera de <cite>validación</cite></footer>
                                               </blockquote>
                                           </div>

                                             <div class="form-group col-md-6">
                                                   <div class="col-md-12 mt-5 my-5" style="text-align : center;">
                                                      <img src="../../..//img/huella.png" id="icon" width="150px">
                                                  </div>
                                                  <div class="col-md-12" style="text-align : center;">
                                                      TOKEN : <?php echo $KEY; ?>
                                                  </div>
                                                  <div class="col-md-12" style="text-align : center;">
                                                      <small><b><i class="fas fa-info-circle"></i> Abre el sistema gestor de huellas para realizar la validación.</b></small>
                                                  </div>
                                             </div>


                                           <div class="form-group col-md-6">
                                                   <a href = "../../" class="btn btn-danger float-left"><i class="fas fa-window-close"></i> Cancelar</a>
                                           </div>

                                           <div class="form-group col-md-6">
                                                   <button class="btn my-btn-blue float-right validate-card" style="width:250px;"><i class="fas fa-fingerprint"></i> Validar</button>
                                           </div>

                                       </div>
                                    </div>
                              </div>
                        </div>



                        <div class="invoi d-change d-none">
                              <div class = "row">
                                    <div class="col-sm-12 col-12 ">
                                           <a href = "../../" class="btn btn-danger btn-sm float-left" style="width: 250px;"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>
                                </div>
                          </div>

                        <div class="invoi d-change d-none">
                              <div class = "row">

                                    <div class="col-sm-12 col-12 ">
                                        <h5>Seleccione el Tipo de Canje</h5>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <select class = "form-control form-control-sm type_change">
                                                        <option value = "0">Seleccione</option>
                                                        <option value = "1">Pintura y Complementos</option>
                                                        <option value = "2">Productos Diversos</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3 i-fol d-none">
                                                <input type = "text" class = "form-control form-control-sm" id ="remision" placeholder="Ingrese Folio de Remisión"/>
                                            </div>

                                            <div class="col-sm-3 i-fol d-none">
                                                  <button class = "btn my-btn-blue btn-sm btn-remision" style="width:250px;"><i class="fas fa-clipboard-check"></i> Verificar</button>
                                            </div>
                                        </div>

                                    </div>
                              </div>
                        </div>



                        <div class="invoi d-change d-none">
                              <div class = "row">

                                    <div class="col-sm-6 col-12 d-prod-server">
                                          <div class="form-group row">
                                              <label for="serieventa" class="col-sm-2 col-form-label col-form-label-sm">Productos</label>
                                              <div class="col-sm-10">
                                                <?php
                                                if($datos == null)
                                                  {
                                                     echo "<h5>No existen productos para canjear</h5>";
                                                 }
                                                 else{ ?>
                                                  <select class = "form-control form-control-sm prods">
                                                          <option value = "0">Seleccione</option>
                                                      <?php
                                                            for($x=0; $x < count($datos); $x++) {
                                                                echo "<option value = '".$datos[$x]["id"]."' data-cant = '".$datos[$x]["cantidad"]."'  data-price = '".$datos[$x]["precio"]."' data-desc = ' ".$datos[$x]["producto"]."'>".$datos[$x]["producto"]." [".$datos[$x]["cantidad"]."]</option>";
                                                            }
                                                      ?>
                                                  </select>
                                                <?php } ?>
                                              </div>
                                          </div>
                                    </div>



                                   <div class="col-sm-12 col-12 d-prod-local">
                                         <div class="form-group row">
                                             <label for="serieventa" class="col-sm-4 col-form-label col-form-label-sm">Productos de la remisión</label>
                                             <div class="col-sm-8">
                                                    <select class = "form-control form-control-sm prods prods-local"></select>
                                             </div>
                                         </div>
                                   </div>



                              </div>
                       </div>




                           <div class="invoi d-codes d-none">
                                 <div class = "row">

                                    <div class="col-sm-12 col-12 ">
                                          <div class="table-responsive  mt-3">
                                                  <table class="table  table-sm table-prods">
                                                      <tbody class ="t-prods"></tbody>
                                                  </table>
                                          </div>
                                    </div>

                                    <div class="col-sm-12 col-12 my-4 d-total" style="text-align:right;">
                                    </div>

                                    <div class="col-sm-12 col-12 my-4" style="text-align:right">
                                        <button class = "btn my-btn-blue-only-border  btn-change d-none" style="width: 250px;"><i class="fas fa-check-circle"></i> Canjear</button>
                                    </div>

                                 </div>
                            </div>








                    <?php
                        }
                        else {
                   ?>
                       <div class="invoi">
                             <div class = "row">
                                   <div class="col-sm-12 col-12 ">
                                     <div class="form-row">
                                           <div class="form-group col-md-12">
                                                    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> <span><b>No es posible sincronizar con el servidor</b>, verifique su conexión</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                      <?php } ?>


                            <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div>
            </div>
        </div>

      <?php echo "<script>var identified = '".$data->idpintor."'; var token = '".$KEY."'; </script>";?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>
    <script src ="<?php echo PATH; ?>js/dotcard/change.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>

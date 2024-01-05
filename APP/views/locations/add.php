<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>
    <title> <?php  if(!$data->edit) { echo 'New Location'; } else { "Edit Location"; }?></title>
  </head>
  <body>
    
  <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/sidebar.php"?>

        <div class="content">
        
        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/navbar.php"?>


              <div class="container-fluid ">
                    <div class="row">
                        <div class="invoi" style ="margin-bottom: 1px;">  
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                        <i class="fa fa-home"></i> <?php 
                                             if(!$data->edit) { echo "Ingrese los datos de la nueva sucursal "; }
                                             else{ echo "Modifique los datos de la sucursal ";}
                                        ?>
                                </div>
                            </div>
                        </div>

                        <div class="invoi"> 

                        <form id="f-add" onsubmit="return valida(this);" method="POST" action="javascript:coid(0);">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 ">
                                <div class="msg-validadion"></div><br>
                            </div>

                        <div class="col-md-6 col-sm-12 col-12 ">


                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Clave</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->nombre)){ echo $data->idsucursal; } ?>' class="form-control form-control-sm" id="key" name="key" placeholder="Ingrese clave" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->nombre)){ echo $data->nombre; } ?>' id="name" name="name" placeholder="Ingrese nombre" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Serie</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->serie)){ echo $data->serie; } ?>' id="serie" name="serie" placeholder="Ingrese serie">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Dirección</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->direccion)){ echo $data->direccion; } ?>' id="direc" name="direccion" placeholder="Ingrese dirección">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Colonia</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->colonia)){ echo $data->colonia; } ?>' id="colonia" name="colonia" placeholder="Ingrese colonia">
                                </div>
                            </div>

                              
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Número Exterior</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->num_exterior)){ echo $data->num_exterior; } ?>' id="numexterior" name="numexterior" placeholder="Ingrese número exterior">
                                </div>
                            </div>

   
                            <div class="form-group row">
                                <label for="name" class="col-sm-12 col-form-label col-form-label-sm text-danger">Todos los campos son obligatorios.</label>
                            </div>
                        </div>       
                        <div class="col-md-6 col-sm-12 col-12 ">
                        
                         

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Número Interior</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->num_exterior)){ echo $data->num_exterior; } ?>' id="numinterior" name="numinterior" placeholder="Ingrese número interior">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Código Postal</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->codigo_postal)){ echo $data->codigo_postal; } ?>' id="cp" name="cp" placeholder="Ingrese código postal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Municipio</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->ciudad)){ echo $data->ciudad; } ?>' id="municipio" name="municipio" placeholder="Ingrese municipio">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->estado)){ echo $data->estado; } ?>' id="estado" name="estado" placeholder="Ingrese estado">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">País</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->pais)){ echo $data->pais; } ?>' id="pais" name="pais" placeholder="Ingrese país">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Tipo de Sucursal</label>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control form-control-sm">


                                    <?php 
                                        if(!$data->edit)
                                        {  
                                    ?>
                                        <option value = "1">Tienda</option>
                                        <option value = "2">Almacén</option>
                                        <option value = "3">Auditoria</option>
                                    
                                    <?php
                                        }
                                        else{
                                            $select_one = $data->tipo == 1 ? 'selected' : '';
                                            $select_two = $data->tipo == 2 ? 'selected' : '';
                                            $select_three = $data->tipo == 3 ? 'selected' : '';
                                            
                                            echo '<option value = "1" '.$select_one.'>Tienda</option>
                                                  <option value = "2" '.$select_two.'>Almacén</option>
                                                  <option value = "3" '.$select_three.'>Auditoria</option>';
                                        
                                        }
                                    ?>

                                    </select>
                                </div>
                            </div>

                             <div class="form-group row">
                              <?php 

                                if($data->edit)
                                {   
                                    echo "<input type='hidden' name='serie_update' value='".$data->serie."'>";
                                    echo "<input type='hidden' name='num_suc' value='".$data->idsucursal."'>";
                                    echo '<button type="submit" class="btn btn-primary btn-block" id="b-add-location"><i class="fas fa-save"></i> Actualizar información</button>';
                                }
                                else{
                                    echo '<button type="submit" class="btn btn-success btn-block" id="b-add-location"><i class="fas fa-save"></i> Registrar</button>';
                                }
                              ?>
                            
                            </div>

                            </div>

                            </form>
                        </div>  
                
                        </div>
                         
                        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>

                        </div>
                    </div> 
            </div>  

        </div>
        

    </div>


    <?php if($data->edit) {  echo "<script>var edit = true; var il = ".$data->idsucursal.";</script>"; } else{ echo "<script> var edit = false; var il = null; </script>"; } ?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>  
    <script src ="<?php echo PATH; ?>js/locations/add.js"></script>

    <script>
        $(document).ready(function(){
            $("#sidebarCollapse").on('click', function(){
                $("#sidebar").toggleClass("active");
            });
        });
    
    </script>


</body>
</html>
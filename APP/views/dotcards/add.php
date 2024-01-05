<!doctype html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/head.php"?>

    <title> <?php  if(!$data->edit) { echo 'New Dotcar'; } else { echo"Edit Dotcard"; }?></title>
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
                                     <i class="fas fa-credit-card"></i> <?php 
                                             if(!$data->edit) { echo "Ingrese los datos de la tarjeta puntos "; }
                                             else{ echo "Modifique los datos de la tarjeta puntos ";}
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
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Tarjeta</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly ="readonly" value='<?php if(isset($data->num_tarjeta)){ echo $data->num_tarjeta; } ?>' class="form-control form-control-sm" id="card" name="card" placeholder="Ingrese tarjeta" >
                                    <input type = "hidden" name = "cardh" id = "cardh" value = '<?php if(isset($data->num_tarjeta)){ echo $data->num_tarjeta; } ?>' />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->telefono)){ echo $data->telefono; } ?>' class="form-control form-control-sm" maxlength = "10" id="phone" name="phone" placeholder="Ingrese teléfono" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Puntos</label>
                                <div class="col-sm-10">
                                <input type="text" readonly value='<?php if(isset($data->puntos)){ echo $data->puntos; } else { echo 0; } ?>' class="form-control form-control-sm" id="points" name="points" placeholder="Ingrese puntos" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Dirección</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->direccion)){ echo $data->direccion; } ?>' maxlength = "43" class="form-control form-control-sm" id="direction" name="direction" placeholder="Ingrese dirección" >
                                </div>
                            </div>

                            

                        </div>  


                        <div class="col-md-6 col-sm-12 col-12 ">
                        
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Nombre </label>
                                <div class="col-sm-10">
                                 <input type="text" class="form-control form-control-sm" value='<?php if(isset($data->nombre)){ echo $data->nombre; } ?>' maxlength = "43" id="name" name="name" placeholder="Ingrese nombre del pintor">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->email)){ echo $data->email; } ?>' class="form-control form-control-sm" maxlength = "43" id="email" name="email" placeholder="Ingrese email" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Descuento</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->descuento)){ echo $data->descuento; } ?>' class="form-control form-control-sm" id="descount" name="descount" placeholder="Ingrese descuento" >
                                </div>
                            </div>  


                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">*Ocupación</label>
                                <div class="col-sm-10">
                                <input type="text" value='<?php if(isset($data->ocupacion)){ echo $data->ocupacion; } ?>' maxlength = "30" class="form-control form-control-sm" id="occupation" name="occupation" placeholder="Ingrese ocupación" >
                                </div>
                            </div>
                

                            </div>  <!-- End row --->
                            
                        
                                    <div class="col-md-12 col-sm-12 col-12 ">

                                            <div class="row">

                                                <div class="col-md-6 col-sm-12 col-12 ">

                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-12 col-form-label col-form-label-sm text-danger">Los campos con * (asterisco) son obligatorios.</label>
                                                    </div>


                                                </div>   <!-- End md-6 --->

                                            <div class="col-md-6 col-sm-12 col-12 ">

                                                    <div class="form-group row my-5">

                                                    <?php 

                                                        if($data->edit)
                                                        {   
                                                           // echo "<input type='hidden' name='card_update' value='".$data->num_tarjeta."'>";
                                                           // echo '<button type="submit" class="btn btn-primary btn-block" id="b-add-dotcard"><i class="far fa-save"></i> Actualizar información</button>';
                                                        }
                                                        else{
                                                           // echo '<button type="submit" class="btn btn-success btn-block" id="b-add-dotcard"><i class="far fa-save"></i> Registrar</button>';
                                                        }
                                                    ?>
                                                    
                                                    </div>
                                            </div> <!-- End md-6 --->
                                        
                                        </div>  <!-- End rows --->



                                   <div class = "alert alert-info"><b> Esta función no esta disponible </b></div>

                                </div>  <!-- End col-md-12 --->


                            </form>
                        </div>  
                
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/footer.php"?>
                        </div>
                    </div> 
            </div>  

        </div>
        

    </div>


    <?php if($data->edit) {  echo "<script>var edit = true; var idc = ".$data->idpintor."; </script>"; } else{ echo "<script> var edit = false; var idc = null; </script>"; } ?>
 
    <?php include $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/app/views/includes/scripts.php"?>  

    <?php if(false){ ?>
    <script src ="<?php echo PATH; ?>js/dotcard/add.js"></script>
    <?php } ?>

</body>
</html>
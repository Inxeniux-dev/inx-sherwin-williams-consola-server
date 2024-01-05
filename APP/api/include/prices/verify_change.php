<?php


if(!$_SESSION["permissions"][53]->status) {  echo '<div class = "alert alert-warning">No tienes permisos para realizar esta operación</div>'; return; }


$datosRecibidos = file_get_contents("php://input");
$items_server = json_decode($_POST["data"]);

$items = $model->getItems(-1, 0, 0, null, null, null);


$output_table = ' <table class = "table table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cambio</th>
                        <th>Descuento</th>
                        <th style = "text-align:right;">Precio Actual</th>
                        <th style = "text-align:right;">Precio Nuevo</th>
                    </tr>
                </thead>
                <tbody>';


    $items_list = null;
    while($row = $items->fetch_object())
    {
        $items_list[] = $row;
    }


    $count_change = 0;
    for($x=0; $x<count($items_server); $x++)
    {
        $data_server = $items_server[$x];

        $codigo = strval($data_server->codigo);
        $precio = $data_server->prec_vent;
        $descripcion = $data_server->descrip;
        $descuento = $data_server->descont;
        $fecha_ini = $data_server->fechini;
        $fecha_fin = $data_server->fechfin;
        $clave_sat = $data_server->clavesat;
        $idcapacidad = $data_server->idcapacidad;
        $es_base = $data_server->es_base;
        $linea = $data_server->linea;

        $display = 0;
        $change_msj = "";

       //  $response = array_search(trim(strval($codigo)), array_column($items_list, 'codigo'));
        $response = searchForId(trim(strval($codigo)), $items_list);

        if(strlen($response) == 0)
        {
          $count_change++;
          $output_table.= "<tr>
                    <td>".$count_change."</td>
                    <td>".$codigo."</td>
                    <td><b>".$descripcion."</b></td>
                    <td align = 'center' class = 'text-primary'><b>Producto Nuevo</b></td>
                    <td  align = 'right'>".$descuento."%</td>
                    <td align = 'right'></td>
                    <td  align = 'right'>$".number_format($precio,2)."</td>
                <tr>";

        }
        else {

            $data_local = $items_list[$response];

            if($precio != $data_local->precio)
            {   $display++;
                $change_msj .=  "Precio <br>";
            }

            $descripcion_xml = trim(strtoupper($descripcion));
            $descripcion_local = trim(strtoupper($data_local->descripcion));

            if($descripcion_xml != $descripcion_local)
            {    $display++;
                $change_msj .=  "Descripción <br>";
            }

            if($descuento != $data_local->descuento)
            {   $display++;
                $change_msj .=  "Descuento <br>";
            }

            if($idcapacidad != $data_local->id_capacidad)
            {   $display++;
                $change_msj .=  "Cambio de Capacidad <br>";
            }

            if($clave_sat != $data_local->clave_sat)
            {
                $display++;
                $change_msj .=  "Clave Sat <br>";
            }

            if($linea != $data_local->idlinea)
            {   $display++;
                $change_msj .=  "Cambio de Linea <br>";
            }

            if($es_base != $data_local->es_base)
            {   $display++;

                if($data_local->es_base == 1)
                {
                    $change_msj .=  "Es base para Igualado <br>";
                }
                else
                {
                     $change_msj .=  "No es base para Igualado <br>";
                }

            }

            if($fecha_ini != $data_local->fecha_inicial || $fecha_fin != $data_local->fecha_final)
            {   $display++;
                $change_msj .=  "Fecha de campaña <br>";
            }


              if($display > 0)
              { $count_change++;
                $output_table.= "<tr>
                                    <td>".$count_change."</td>
                                    <td>".$codigo."</td>
                                    <td>".$descripcion_xml."</td>
                                    <td align = 'center'><b>".$change_msj."</b></td>
                                    <td align = 'center'>".$descuento."%</td>
                                    <td align = 'right'>$".number_format($data_local->precio,2)."</td>
                                    <td align = 'right'>$".number_format($precio,2)."</td>
                                <tr>";
              }
        }
    }

    $output_table.="</tbody></table>";


    if($count_change > 0)
    {
      $output = "<div class = 'col-md-12 mt-4' style = 'text-aling: center;'><button class = 'btn my-btn-blue btn-confirm' style = 'width:350px;'><i class='fas fa-check-circle'></i> Confirmar la Actualización de Precios</button></div><div class = 'col-md-12 mt-4'><h5 class = 'text-primary'><b>Listado de productos por actualizar </b></h5></div>".$output_table;
    }
    else {
      $output = $output_table;
    }


  echo $output;




  function searchForId($code, $array) {
       foreach ($array as $key => $val) {
           if (strtoupper($val->codigo) === strtoupper($code)) {
               return $key;
           }
       }
       return null;
    }
?>

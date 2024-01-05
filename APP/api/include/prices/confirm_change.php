<?php

if($_SESSION["config"]["bloqueo"] == 1) { echo json_encode(["code" => 200, "status" => false, "msg" => "Ya se ha generado el reporte del cierre del día", "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

if(!$_SESSION["config"]["unlok_system"])
{
    if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "msg" => "La fecha del corte no coincide con la fecha del sistema",  "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
}



$datosRecibidos = file_get_contents("php://input");
$items_server = json_decode($_POST["data"]);
$items = $model->getItems(-1, 0, 0, null, null, null);

$items_list = null;
while($row = $items->fetch_object())
{
    $items_list[] = $row;
}


$PRODUCTOS_UPDATE = array();

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
      $data_server->new = 1;
      $PRODUCTOS_UPDATE[] = $data_server;
    }
    else {
        $data_server->old_price = $items_list[$response]->precio;
        $data_server->existencia = $items_list[$response]->existencia;

        $data_local = $items_list[$response];

        if($precio != $data_local->precio)
        {   $display++;

        }

        $descripcion_xml = trim(strtoupper($descripcion));
        $descripcion_local = trim(strtoupper($data_local->descripcion));

        if($descripcion_xml != $descripcion_local)
        {    $display++;
        }

        if($descuento != $data_local->descuento)
        {   $display++;
        }

         if($idcapacidad != $data_local->id_capacidad)
        {   $display++;
        }

        if($es_base != $data_local->es_base)
        {   $display++;
        }

        if($clave_sat != $data_local->clave_sat)
       { $display++;
       }

        if($linea != $data_local->idlinea)
        {   $display++;
        }

        if($fecha_ini != $data_local->fecha_inicial || $fecha_fin != $data_local->fecha_final)
        {   $display++;
        }

        if($display > 0)
        { $count_change++;
          $PRODUCTOS_UPDATE[] = $data_server;
        }
    }
}



$response = $model->ChangePrice($PRODUCTOS_UPDATE);
$msg = "";
$error = [];
if(!$response["save"])
{
    $error = ["Error al realizar el proceso"];
}
else {
    $msg = "Proceso Finalizado";
}

echo json_encode(["code" => 200, "status" => $response["save"], "msg" => $msg, "error" => $error, "info" => $response]);
return;



function searchForId($code, $array) {
     foreach ($array as $key => $val) {
         if (strtoupper($val->codigo) === strtoupper($code)) {
             return $key;
         }
     }
     return null;
  }


?>

<?php

$sucursales = array();
$sql_sucursal = "SELECT idsucursal, nombre, version, almacen, trabaja_domingo FROM c_server.sucursal WHERE status = 1;";
$response = $conexion->query($sql_sucursal);

while($row = $response->fetch_object())
{
      if($location > 1)
      {
        if($location == $row->idsucursal)
        {
            $sucursales[$row->idsucursal] = ["name" => $row->nombre, "version" => $row->version, "almacen" => $row->almacen, "id" => $row->idsucursal, "trabaja_domingo" => $row->trabaja_domingo]; break;
        }
      }
      else {   $sucursales[$row->idsucursal] = ["name" => $row->nombre, "version" => $row->version, "almacen" => $row->almacen, "id" => $row->idsucursal, "trabaja_domingo" => $row->trabaja_domingo];  }
}

$sucursales = json_decode(json_encode($sucursales));


$json_data = array();

$date_server = date("Y-m-d");
$date_anterior = date("Y-m-d", strtotime($date_server."- 1 days"));

foreach ($sucursales as $key => $value) {
  $VERSION_SUCURSAL = $value->version;
  $NAME_SUCURSAL = addCeros($key)."-".$value->name;
  $ES_ALMACEN = $value->almacen;
  $NAME_DB = "sucursal_".addCeros($key);
  $CLAVE_SUC = addCeros($key);
  $trabaja_domingo = $value->trabaja_domingo;


  $msg = '';

    if($ES_ALMACEN == 0 || $ES_ALMACEN == 3)
    {
        $sql  = "SELECT version, fecha_corte FROM ".$NAME_DB.".configuracion LIMIT 1;";
        $res = $conexion->query($sql);
        $version = '';
        $corte = '';

        if($res)
        {
          while($row = $res->fetch_object())
          {
              $version = $row->version;
              $corte = $row->fecha_corte;
          }
        }

        $dias = abs(diasEntreFechas($corte, $date_server));
        $desface = 0;
        $limite  = $trabaja_domingo == 1 ? 1 : 2;  //Número de días tolerancia
        $name_dia = nameDia($corte);

        //$limite = nameDia($corte) == "Domingo" ? $limite : 1;


        if($dias > $limite)
        {
            $desface = 1;
            $msg = 'El respaldo no esta al día';
        }

         $file = '';

         $config = get_config($conexion);
         $path_backup = $config->path_backup;
         $path_file = $path_backup."sucursal_".$CLAVE_SUC."/respaldo_actual.gz";

         if (file_exists($path_file)) {
              $file =  fechaCortaAbreviadaConHora(date("Y-m-d H:i:s", filemtime($path_file)));
         }
         else {
            $path_file = $path_backup."sucursal_".$CLAVE_SUC."/respaldo_actual.zip";
            if (file_exists($path_file)) {
                 $file =  fechaCortaAbreviadaConHora(date("Y-m-d H:i:s", filemtime($path_file)));    //SI NO ENCUENTRA EL .GZ BUSCAMOS UN ARCHIVO .ZIP
            }
         }

         $path_file = str_replace(["A:/", "B:/", "C:/", "D:/", "F:/", "G:/", "H:/", "I:/", "respaldo_actual.gz", "respaldo_actual.zip"], [], $path_file);

         $msg = strlen($corte) == 0 ? "Base de datos no encontrada" : $msg;
         $corte = strlen($corte) == 0 ? "-" : fechaCortaAbreviadaConHora($corte);

         $json_data[] = array("clave" => addCeros($key), "sucursal" => $NAME_SUCURSAL, "version" => $version, "corte" => $corte, "desface" => $desface, "msg" => $msg, "file" => $file , "path" => $path_file);
    }
}


$time_final = date("Y-m-d H:i:s");

echo json_encode(["code"=> 200, "data" => $json_data]);
return;

?>
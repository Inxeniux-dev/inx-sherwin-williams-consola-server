<?php

$sucursales = array();
$sql_sucursal = "SELECT idsucursal, nombre, version, almacen FROM c_server.sucursal WHERE status = 1;";
$response = $conexion->query($sql_sucursal);

while($row = $response->fetch_object())
{
      if($location > 1)
      {
          if($location == $row->idsucursal)
          {
              $sucursales[$row->idsucursal] = ["name" => $row->nombre, "version" => $row->version, "almacen" => $row->almacen, "id" => $row->idsucursal]; break;
          }
      }
      else {   $sucursales[$row->idsucursal] = ["name" => $row->nombre, "version" => $row->version, "almacen" => $row->almacen, "id" => $row->idsucursal];  }
}

$sucursales = json_decode(json_encode($sucursales));



$json_data = array();

$date_server = date("Y-m-d");
$date_anterior = date("Y-m-d",strtotime($date_server."- 1 days"));



foreach ($sucursales as $key => $value) {
  $VERSION_SUCURSAL = $value->version;
  $NAME_SUCURSAL = $value->name;
  $ES_ALMACEN = $value->almacen;
  $NAME_DB = "sucursal_".addCeros($key);
  $CLAVE_SUC = addCeros($key);


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

        $desface = 0;
        if($date_anterior > $corte)
        {
            $desface = 1;
            $msg = 'El respaldo no esta al día';
            $json_data[] = array("idsucursal" => addCeros($key), "nombre" => $NAME_SUCURSAL, "version" => $version, "corte" => fechaCortaAbreviadaConHora($corte), "desface" => $desface);
        }

    }
}



foreach ($json_data as $key => $value) {

  $value = to_object($value);

  $sucursal = "sucursal_".addCeros($value->idsucursal);
  $sucursal_name = $value->nombre;

  $output .= '@echo  Restaurando Sucursal '.$sucursal." - ".$sucursal_name;
  $output .= "\n";
  $output .= 'del "F:\Respaldos\\'.$sucursal.'\\'.$sucursal.'.sql"';
  $output .= "\n";
  $output .= '@echo - Descomprimiendo '.$sucursal.' - '.$sucursal_name;
  $output .= "\n";
  $output .= '"C:\Program Files\WinRAR\winrar.exe" x -hp2eae72fea4132b283a7a701199ab6c80efd42a6f "F:\Respaldos\\'.$sucursal.'\respaldo_actual.gz" "F:\Respaldos\\'.$sucursal.'\"';
  $output .= "\n";
  $output .= 'cd C:\AppServ\MySQL\bin';
  $output .= "\n";
  $output .= '@echo - Restaurando '.$sucursal.' - '.$sucursal_name.' ...';
  $output .= "\n";
  $output .= 'mysql -u root -pGCHydra.16* '.$sucursal.' < F:\Respaldos\\'.$sucursal.'\\'.$sucursal.'.sql';
  $output .= "\n";
  $output .= "\n\n\n";

}


$file = fopen(PATH_FILES_BACKUPS."upload_backups_pend.bat", "w");

if(!fwrite($file, $output . PHP_EOL))
{
   return false;
}

if(!fclose($file))
{
    return true;
}

echo json_encode(["code"=> 201, "error" => ["Backup Creado Correctamente"]]); return;
?>

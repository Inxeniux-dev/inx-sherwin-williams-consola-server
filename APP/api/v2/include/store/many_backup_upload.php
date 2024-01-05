<?php

$time_init = date("Y-m-d H:i:s");

$dateFinaly = isset($_GET["date"]) ? $_GET["date"] : date("m");
$key = isset($_GET["key"]) ? $_GET["key"] : 0;
$location = isset($_GET["location"]) ? $_GET["location"] : 0;



$sucursales = array();
$sql_sucursal = "SELECT idsucursal, nombre, version, almacen FROM c_server.sucursal;";
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


$sql_bases = "SHOW DATABASES";
$response = $conexion->query($sql_bases);
$data_bases = array();
$cont = 0;
while($row = $response->fetch_object())
{
  $pos = strpos($row->Database, "sucursal_");
  if ($pos === false) {
  }
  else {
      $data_bases[$cont] = $row->Database;
      $cont++;
  }
}


$json_data = array();

$date_server = date("Y-m-d");
$date_anterior = date("Y-m-d",strtotime($date_server."- 1 days"));

foreach ($sucursales as $key => $value) {
  $VERSION_SUCURSAL = $value->version;
  $NAME_SUCURSAL = $key."-".$value->name;
  $ES_ALMACEN = $value->almacen;
  $NAME_DB = "sucursal_".addCeros($key);


  $msg = '';

  if(in_array($NAME_DB, $data_bases))
  {

    if($ES_ALMACEN == 0)
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
      }

       $json_data[] = array("sucursal" => $NAME_SUCURSAL, "version" => $version, "corte" => $corte, "desface" => $desface, "msg" => $msg);
    }
  }
  else {
    //  $json_data[] = array("sucursal" => $NAME_SUCURSAL, "data" => null);
  }
}


$time_final = date("Y-m-d H:i:s");

echo json_encode(["code"=> 200, "data" => $json_data]);
return;



?>

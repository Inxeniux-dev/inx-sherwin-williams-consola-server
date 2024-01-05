<?php

  $key_suc = isset($_GET["key_suc"]) ? $_GET["key_suc"] : '';
  $proyect = isset($_GET["proyect"]) ? $_GET["proyect"] : 0;

  if(strlen(trim($key_suc)) == 0)
  {
      echo json_encode(["code" => 400, "message" => "La sucursal es incorrecta"]);
      return;
  }

  if(strlen(trim($proyect)) == 0 || !is_numeric($proyect) || $proyect <= 0)
  {
      echo json_encode(["code" => 400, "message" => "La clave del proyecto es incorrecta"]);
      return;
  }

  $version = new VersionModel();
  $ult_ver = $version->getLastVersionProductionByProyect($proyect);
  if(!$ult_ver || $ult_ver->num_rows == 0)
  {
      echo json_encode(["code" => 500, "message" => "Internal Server Error"]);
      return;
  }

  $ult_ver = $ult_ver->fetch_object();
  $version->id = $ult_ver->id;
  $data = $version->one();

  if(!$data || $data->num_rows == 0)
  {
      echo json_encode(["code" => 500, "message" => "Internal Server Error"]);
      return;
  }

  $create_at = date("Y-m-d");
  $version = 0;
  $vencimiento = SumarORestarFechas($create_at, "+", 3, "days");

  while($row = $data->fetch_object())
  {
      $create_at = $row->create_at;
      $version = $row->version;
      $vencimiento = SumarORestarFechas($create_at, "+", $row->dias_limite, "days");
      $sucursales = $row->sucursales;
  }

  $permitidas = json_decode($sucursales);

  if(count($permitidas) == 0)
  {
      echo json_encode(["code" => 400, "message" => "La sucursal no esta permitida para sincronizar"]); return;
  }

  $sucursales = array();
  foreach ($permitidas as $key => $value) {
      $sucursales[] = $key;
  }
  
  if(in_array($key_suc, $sucursales)) {
    echo json_encode(["code" => 200, "message" => "OK", "version" => $version, "date" => $create_at, "vencimiento" => $vencimiento]); return;
  }

  echo json_encode(["code" => 400, "message" => "No se puede sincronizar"]); return;
?>

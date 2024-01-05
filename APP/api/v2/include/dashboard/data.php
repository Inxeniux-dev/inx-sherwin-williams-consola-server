<?php

  $key_suc = isset($_GET["key_suc"]) ? $_GET["key_suc"] : '';
  $proyect = isset($_GET["proyect"]) ? $_GET["proyect"] : 0;

  if(strlen(trim($key_suc)) == 0)
  {
      echo json_encode(["code" => 400, "message" => "La sucursal es incorrecta"]);
      return;
  }


  $price = new PriceModel();
  $lasts = $price->getLastPrices();
  
  if($lasts)
  {
    $prices = null;

    while($row = $lasts->fetch_object())
    {
        $prices[] = $row;
    }

    echo json_encode(["code" => 200, "message" => "OK", "data" => $prices]); return;
  }
  

  echo json_encode(["code" => 400, "message" => "No se puede sincronizar"]); return;
?>

<?php

if(MODE == "SERVER")
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["No se puede sincronizar, cuando estás en modo SERVIDOR"], "msg" => "Sincronización Fallida"]);
  return;
}

  $url = $_SESSION["config"]["api_url"]."/prices/index.php?&&key=".API_KEY;
  $data = null;
  

  $options = stream_context_create(array('http'=>
    array(
    'timeout' => TIMEOUT_SYNC_PRICES
    )
));

$status_conection = false;
if(@file_get_contents($url, false, $options)){
    $json = file_get_contents($url);
    $status_conection = true;
        if($json != null )
        {
            $data = json_decode($json, true);
        }
 }


 echo json_encode(["code" => 200, "status" => true, "error" => [], "msg" => "Sincronización Finalizada", "data" => $data]);
 return;
?>

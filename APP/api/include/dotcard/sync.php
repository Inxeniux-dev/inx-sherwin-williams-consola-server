<?php

if(MODE == "SERVER")
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["No se puede sincronizar, cuando estás en modo SERVIDOR"], "msg" => "Sincronización Fallida"]);
  return;
}

  $url = $_SESSION["config"]["api_url"]."/pointcard/sync_v2.php?&&key=".API_KEY;
  $data = null;

  $options = stream_context_create(array('http'=>
    array(
    'timeout' => TIMEOUT_SYNC_CARDS
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

   if($data == null || empty($data))
   {
     echo json_encode(["code" => 200, "status" => false, "error" => ["No se ha establecido la comunicación con el servidor"], "msg" => "Sincronización Fallida"]);
     return;
   }

   foreach ($data as $key => $value) {
        $value = json_decode(json_encode($value));
        $response = $model->updateDotCardTest($value);
   }

   echo json_encode(["code" => 201, "status" => true, "error" => [], "msg" => "Sincronización Finalizada"]);
   return;
?>

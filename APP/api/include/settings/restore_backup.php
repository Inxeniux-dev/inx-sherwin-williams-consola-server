<?php

if(!$_SESSION["permissions"][45]->status) { echo json_encode(["code" => 200, "status" => false, "error" => ["No tienes permisos para realizar esta operación"]]); return; }

if(MODE == "PDV")
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["No se puede sincronizar, cuando estás en modo PDV"], "msg" => "Sincronización Fallida"]);
  return;
}


$url = $_SESSION["config"]["api_url"]."backup/ult_backup.php?key=".API_KEY."&suc=".$_SESSION["config"]["key_suc"];



$head = array(
     "name" => $_SESSION['datauser']["name"],
     "sucursal" => $_SESSION["config"]["key_suc"],
     "fecha" => $_SESSION["config"]["date_corte"]." ".date(" H:i:s")
 );


$payload = json_encode(array("data" => $head));

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$resp = curl_exec($curl);
curl_close($curl);

if($resp)
{
   $resp = json_decode($resp);

   if($resp->code == 201)
   {
      $model->sessionStart();
      echo json_encode(["code" => 201, "msg" => "El respaldo ha sido actualizado", "data" => $resp]);
      return;
   }
}

echo json_encode(["code" => 200, "msg" => "El respaldo no se ha actualizado", "error" => ["El respaldo no ha sido actualizado"]]);
return;

?>

<?php

if(MODE == "SERVER")
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["No se puede sincronizar, cuando estás en modo SERVIDOR"], "msg" => "Sincronización Fallida"]);
  return;
}

  $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
  $data = $saleModel->get_gales_sync();

  $result = [];
  if($data)
  {
      if($data->num_rows > 0)
      {
            $canjes = array();
            while ($row = $data->fetch_object())
            {
                $canjes [] = array (
                     "idcard" => $row->idpintor,
                     "card" => $row->num_tarjeta,
                     "remision" => $row->folio,
                     "points" => $row->puntos,
                     "fecha" => $_SESSION["config"]["date_corte"],
                     "idsuc" => $_SESSION["config"]["key_suc"],
                     "token" => $row->token,
                     "idremision" => $row->idventa
                 );
            }


            $data = array(
                'key' => API_KEY,
                "exchange" => $canjes
            );

             $url = $_SESSION["config"]["api_url"]."pointcard/acumulate_points_v2.php?&&key=".API_KEY;
             //create a new cURL resource
             $ch = curl_init($url);
             $payload = json_encode($data);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch);
             $respuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
             curl_close($ch);

              if($respuesta == 200)
              {
                  $res  = json_decode($result);
                  if($res->code == 200)
                  {
                      $response = $res->response;
                      foreach ($response as $key => $value) {
                          $value = json_decode(json_encode($value));
                          if($value->code == 201)
                          {
                              $saleModel->delete_sync($value->idremision, $value->token, $value->idcard);
                          }
                      }
                  }
                  $result = json_decode($result);
              }
      }
  }

  echo json_encode(["code" => 200, "res" =>$result]);


?>

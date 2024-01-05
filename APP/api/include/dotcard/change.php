<?php

if($_SESSION["config"]["bloqueo"] == 1) { echo json_encode(["code" => 200, "status" => false, "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

if(!$_SESSION["config"]["unlok_system"])
{
    if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
}

$data = [
    "products" => isset($_POST["products"]) ? json_decode($_POST["products"]) : null,
    "identified" => isset($_POST["identified"]) ? $_POST["identified"] : 0,
    "token" => isset($_POST["token"]) ? $_POST["token"] : null,
    "no_card" =>   isset($_POST["no_card"]) ? $_POST["no_card"] : null,
    "remision" =>  isset($_POST["remision"]) ? $_POST["remision"] : 0,
];

if(strlen($data["token"]) < 10 || !is_numeric($data["token"]))
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["El token es incorrecto"]]); return;
}

if(strlen($data["identified"]) <= 0 || !is_numeric($data["identified"]))
{
   echo json_encode(["code" => 200, "status" => false, "error" => ["El identificador de la tarjeta es incorrecto"]]); return;
}


if(strlen($data["no_card"]) <= 0 || !is_numeric($data["no_card"]))
{
   echo json_encode(["code" => 200, "status" => false, "error" => ["El número de la tarjeta es incorrecto"]]); return;
}

//FALTA VALIDAR LOS PRODUCTOS A CANJEAR

$valid_huella = $model->chekStatusHuella($data);

if(!$valid_huella)
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["La huella no se ha identificado"]]); return;
}

$productos = $data["products"];
$prods = null;
foreach ($productos as $key => $value) {
   $prods[] = array("name" => $value[1], "cant" => 1, "id" => $value[0], "precio" =>  $value[2]);
}


$data = array(
	'key' => API_KEY,
	"idcard" => $data["identified"],
	"card" => $data["no_card"],
	"idsale" => $data["remision"],
	"date" => $_SESSION["config"]["date_corte"],
	"idsuc" => $_SESSION["config"]["key_suc"],
	'prods' => $prods,
);



/*
$card = isset($input["card"]) ? $input["card"] : 0;
$idcard = isset($input["idcard"]) ? $input["idcard"] : 0;
$card = isset($input["card"]) ? $input["card"] : 0;
$idsale = isset($input["idsale"]) ? $input["idsale"] : 0;
$idsuc = isset($input["idsuc"]) ? $input["idsuc"] : 0;
$prods = isset($input["prods"]) ? $input["prods"] : [];
$fecha = isset($input["date"]) ? $input["date"] : 0;
*/

  $payload = json_encode($data);
  $url = $_SESSION["config"]["api_url"]."/pointcard/change_points_v2.php";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_FAILONERROR, true);
  $respuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $datos = curl_exec($ch);
  curl_close($ch);



  if($datos == null){ echo json_encode(["code" => 200, "status" => false, "msg" => null, "error" => ["No se ha establecido la comunicación con el servidor"]]); return; }

  //SI TODO SALE BIEN, EN ESTE MOMENTO AFECTAMOS LOCALMENTE

  $datos = json_decode($datos);

  $error = [$datos->message];
  $msg = $datos->data->msg;


  if($datos->code != 201){ echo json_encode(["code" => 200, "status" => false, "msg" => $msg, "error" => [$msg]]); return;}
  $response = $model->ChangePoints($datos);
  $id_canje = $response["id"];
  $msg = $response["save"] ? "Puntos canjeados correctamente" : "El canje no se ha realizado";
  $error = ["Error al finalizar el canje"];
  echo json_encode(["code" => 200, "status" => $response["save"], "msg" => $msg, "error" => $error, "id_canje" => $id_canje]);
  return;

?>

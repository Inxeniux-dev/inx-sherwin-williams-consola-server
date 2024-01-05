<?php

$date = isset($_POST["date"]) ? $_POST["date"] : null;
$concepto = isset($_POST["concepto"]) ? $_POST["concepto"] : null;

if($date == null || strlen($date) == 0){
  echo json_encode(["code" => 200, "error" => ["La fecha no es correcta"]]); return;
}

if($concepto == null || strlen($concepto) == 0){
  echo json_encode(["code" => 200, "error" => ["el concepto es requerido"]]); return;
}

$inhabilModel->dia_inhabil = $date;
$dia_inhabil = $inhabilModel->findByDiaInhabil();
if(!$dia_inhabil)
{
  echo json_encode(["code" => 200, "error" => ["Error al obtener la fecha"]]);
  return;
}

$count = $dia_inhabil->num_rows;
if($count > 0)
{
  echo json_encode(["code" => 200, "error" =>  ["La fecha ya ha sido registrada anteriormente"]]);
  return;
}


$inhabilModel->create_at = date("Y-m-d H:i:s");
$inhabilModel->user = $_SESSION["datauser"]["name"];
$inhabilModel->concepto = $concepto;

$response = $inhabilModel->create();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al agregar la fecha"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>

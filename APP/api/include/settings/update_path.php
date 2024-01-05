<?php

$path_backup = isset($_POST["path_backup"]) ? $_POST["path_backup"] : null;
$path_log = isset($_POST["path_log"]) ? $_POST["path_log"] : null;
$path_upload = isset($_POST["path_upload"]) ? $_POST["path_upload"] : null;
$path_transfer = isset($_POST["path_transfer"]) ? $_POST["path_transfer"] : null;
$path_orders = isset($_POST["path_orders"]) ? $_POST["path_orders"] : null;
$path_prices = isset($_POST["path_prices"]) ? $_POST["path_prices"] : null;

if($path_backup == null || strlen($path_backup) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de respaldos no es correcto"]]); return;
}
if($path_log == null || strlen($path_log) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de logs no es correcto"]]); return;
}
if($path_upload == null || strlen($path_upload) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de carga de archivos no es correcto"]]); return;
}
if($path_transfer == null || strlen($path_transfer) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de vales de traspaso es incorrecto"]]); return;
}
if($path_orders == null || strlen($path_orders) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de pedidos es incorrecto"]]); return;
}
if($path_prices == null || strlen($path_prices) == 0){
  echo json_encode(["code" => 200, "error" => ["El Path de precios es incorrecto"]]); return;
}

$path_backup = str_replace('\\', '/', $path_backup);
$path_log = str_replace('\\', '/', $path_log);
$path_upload = str_replace('\\', '/', $path_upload);
$path_transfer = str_replace('\\', '/', $path_transfer);
$path_orders = str_replace('\\', '/', $path_orders);
$path_prices = str_replace('\\', '/', $path_prices);

$model->path_backup = $path_backup;
$model->path_log = $path_log;
$model->path_upload = $path_upload;
$model->path_transfer = $path_transfer;
$model->path_orders = $path_orders;
$model->path_prices = $path_prices;

$response = $model->updatePaths();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error actualizar información"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>

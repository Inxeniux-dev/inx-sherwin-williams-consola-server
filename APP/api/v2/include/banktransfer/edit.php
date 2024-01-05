<?php 

$id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
$sucusal = isset($_POST["key_store"]) ? trim($_POST["key_store"]) : '';
$is_server = isset($_POST["is_server"]) ? trim($_POST["is_server"]) : '';

if($id == "" || strlen($id) == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["Transferencia no identificada"]]); return; }


$model = new BankTransferModel();

$model->id = $id;
$transfer = $model->one();
if(!$transfer || $transfer == 0) { echo json_encode(["code" => 200, "error" => ["Transferencia no identificada"]]); return; }

$dataTransfer = $transfer->fetch_object();

if(strlen($sucusal) == 0) { echo json_encode(["code" => 200, "error" => ["Datos incorrectos"]]); return; }
if(!is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["Sucursal no identificada"]]); return; }
if($is_server == "true"){ echo json_encode(["code" => 200, "error" => ["La petición es incorrecta"]]); return; }
	
$model->status = 0;
$model->fecha_confirmacion = $dataTransfer->fecha_confirmacion;
$model->fecha_confirmacion_store = date("Y-m-d H:i:s");
$response = $model->updateStatus();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al editar la transferencia"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
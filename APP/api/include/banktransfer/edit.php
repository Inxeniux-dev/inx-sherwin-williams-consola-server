<?php 

$id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
$is_server = isset($_POST["is_server"]) ? trim($_POST["is_server"]) : '';
$status = isset($_POST["status"]) ? trim($_POST["status"]) : 2;

if($id == "" || strlen($id) == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["Transferencia no identificada"]]); return; }
if($is_server == "false"){ echo json_encode(["code" => 200, "error" => ["La petición es incorrecta"]]); return; }


$model->status = $status;
$model->id = $id;
$model->fecha_confirmacion = date("Y-m-d H:i:s");
$response = $model->updateStatus();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al editar la transferencia"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
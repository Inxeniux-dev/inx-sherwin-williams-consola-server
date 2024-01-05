<?php 

$sucusal = isset($_POST["sucusal"]) ? trim($_POST["sucusal"]) : '';
$importe = isset($_POST["importe"]) ? trim($_POST["importe"]) : '';
$referencia = isset($_POST["referencia"]) ? trim($_POST["referencia"]) : '';

$fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : '';
$cuenta = isset($_POST["cuenta"]) ? trim($_POST["cuenta"]) : 0;
$comentarios = isset($_POST["comentarios"]) ? trim($_POST["comentarios"]) : '';

if($sucusal == "" || strlen($sucusal) == 0){ echo json_encode(["code" => 200, "error" => ["La sucursal no ha sido identificada"]]); return; }
if($importe == "" || strlen($importe) == 0 || $importe <= 0 || !is_numeric($importe)){ echo json_encode(["code" => 200, "error" => ["El importe es incorrecto"]]); return;}
if($fecha == "" || strlen($fecha) == 0){ echo json_encode(["code" => 200, "error" => ["La fecha es incorrecta"]]); return;}
if($cuenta == "" || strlen($cuenta) == 0 || $cuenta <= 0 || !is_numeric($cuenta)){ echo json_encode(["code" => 200, "error" => ["La cuenta es incorrecta"]]); return;}


$model = new BankTransferModel();
$model->sucursal = $sucusal;
$model->importe = $importe;
$model->cuenta = $cuenta;
$model->referencia = $referencia;
$model->fecha_transferencia = $fecha;
$model->fecha_confirmacion = null;
$model->comentarios = $comentarios;
$model->create_at = date("Y-m-d H:i:s");
$model->status = 3;

$response = $model->create();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al crear la transferencia"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
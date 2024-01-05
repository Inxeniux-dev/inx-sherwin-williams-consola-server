<?php 
$id = isset($_GET["id"]) ? trim($_GET["id"]) : '';
$sucusal = isset($_GET["key_store"]) ? trim($_GET["key_store"]) : '';


$model = new BankTransferModel();
$model->id = $id;
$transfer = $model->one();
if(!$transfer || $transfer == 0) { echo json_encode(["code" => 200, "error" => ["Transferencia no identificada"]]); return; }
$dataTransfer = $transfer->fetch_object();

$fecha_confirmacion = ($dataTransfer->fecha_confirmacion == null || $dataTransfer->fecha_confirmacion == "0000-00-00 00:00:00") ? 'No confirmado' : fechaCortaAbreviadaConHora($dataTransfer->fecha_confirmacion);

$fecha_confirmacion_store = ($dataTransfer->fecha_confirmacion_store == null || $dataTransfer->fecha_confirmacion_store == "0000-00-00 00:00:00") ? 'No confirmado' : fechaCortaAbreviadaConHora($dataTransfer->fecha_confirmacion_store);


$transfer = [
	"id" => $dataTransfer->idsucursal,
	"fecha_transferencia" =>$dataTransfer->fecha_transferencia,
	"fecha_confirmacion" => $dataTransfer->fecha_confirmacion,
	"fecha_confirmacion_store" => $dataTransfer->fecha_confirmacion_store,
	"importe" => $dataTransfer->importe,
	"sucursal" => $dataTransfer->nombre,
	"comentario" => $dataTransfer->comentario,
	"comentario_cont" => $dataTransfer->comentario_cont,
	"cuenta" => $dataTransfer->cuenta."-".$dataTransfer->banco,
	"referencia" => $dataTransfer->referencia,
];

echo json_encode(["code" => 201,"transfer" => $transfer]);
return;
?>
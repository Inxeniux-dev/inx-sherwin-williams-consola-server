<?php

$saleServiceIgualMA = new saleServiceIgualMA();
$itemModel = new itemModel();

$identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
$id = isset($_POST["id"]) ? $_POST["id"] : 0;

$data = [
    "line" => isset($_POST["line"]) ? $appService->sanear_string(strtoupper($_POST["line"])) : '',
    "capacity" => isset($_POST["capacity"]) ? $appService->sanear_string($_POST["capacity"]) : '',
    "description" => isset($_POST["description"]) ? $appService->sanear_string($_POST["description"]) : '',
    "cant" => isset($_POST["cant"]) ? $appService->sanear_string($_POST["cant"]) : '',
    "price" => isset($_POST["price"]) ? $appService->sanear_string($_POST["price"]) : '',
    "descount" => 0,
    "products" => isset($_POST["products"]) ? $_POST["products"] : null,
    "identified" => isset($_POST["identified"]) ? $appService->sanear_string($_POST["identified"]) : '',
    "blanco" => isset($_POST["blanco"]) ? $appService->sanear_string($_POST["blanco"]) : 'CB01',
];

$venta = $model->getDataOnlySaleByID($identified);
if($venta == null || !$venta) { echo json_encode(["code" => 200, "status" => false, "error" => ["La venta no ha sido identificada"]]); return; }
if($venta->status != 1) { echo json_encode(["code" => 200, "status" => false, "error" => ["El estatus de la venta es incorrecto"]]); return; }

$validation = to_object($saleServiceIgualMA->igualMAValidation($data));  /* Validamos los datos del POST */
if(!$validation->validation || count($validation->error) > 0) { echo json_encode(["code" => 200, "status" => false, "error" => ["Existen datos incorrectos"]]); return; }

//Validamos el Descuento
$tipo_descuento = $venta->idtipo_descuento;
$response = to_object($model->AddIgualMA($data, $itemModel));
echo json_encode(["code" => 201, "status" => $response->save, "error" => $response->error, "tipo_descuento" => $venta->idtipo_descuento]); return;

?>

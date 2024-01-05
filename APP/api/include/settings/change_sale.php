<?php

$folio = isset($_POST["folio"]) ? $_POST["folio"] : null;
$folio_factura = isset($_POST["folio_factura"]) ? $_POST["folio_factura"] : null;
$folio_devolucion = isset($_POST["folio_devolucion"]) ? $_POST["folio_devolucion"] : null;

$serie_venta = isset($_POST["serie_venta"]) ? $_POST["serie_venta"] : null;
$serie_factura = isset($_POST["serie_factura"]) ? $_POST["serie_factura"] : null;
$num_tickets = isset($_POST["num_tickets"]) ? $_POST["num_tickets"] : null;
$puntos_por_peso = isset($_POST["puntos_por_peso"]) ? $_POST["puntos_por_peso"] : null;

$type_print = isset($_POST["type_print"]) ? $_POST["type_print"] : null;
$printer_name = isset($_POST["printer_name"]) ? $_POST["printer_name"] : null;

$error = array();

if($folio == null || strlen($folio) == 0 || !is_numeric($folio)){
  array_push($error, "El folio de remisión es incorrecto");
}
if($folio_factura == null || strlen($folio_factura) == 0 || !is_numeric($folio_factura)){
  array_push($error, "El folio de factura es incorrecto");
}
if($folio_devolucion == null || strlen($folio_devolucion) == 0 || !is_numeric($folio_devolucion)){
  array_push($error, "El folio de devolución es incorrecto");
}

if($serie_venta == null || strlen($serie_venta) == 0){
  array_push($error, "La serie de remisión es incorrecta");
}
if($serie_factura == null || strlen($serie_factura) == 0){
  array_push($error, "La serie de factura es incorrecta");
}
if($num_tickets == null || strlen($num_tickets) == 0 || !is_numeric($num_tickets) || $num_tickets <= 0){
  array_push($error, "El número de tickets es incorrecto");
}

if($puntos_por_peso == null || strlen($puntos_por_peso) == 0 || !is_numeric($puntos_por_peso) || $puntos_por_peso < 0){
  array_push($error, "Los puntos son incorrectos");
}

if($type_print == null || strlen($type_print) == 0 || !is_numeric($type_print) || $type_print <= 0){
  array_push($error, "El tipo de impresión de ticket es incorrecto");
}
if($printer_name == null || strlen($printer_name) == 0){
  array_push($error, "El nombre de la impresora es incorrecto");
}


if(!empty($error)){ echo json_encode(["code" => 200, "status" =>false, "error" => $error]); return;}

$response = $model->upd_change_sale($folio, $folio_factura, $folio_devolucion, $serie_venta, $serie_factura, $num_tickets, $puntos_por_peso, $type_print, $printer_name);

echo json_encode(["code" => 201, "status" =>true]); return;
?>

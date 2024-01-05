<?php

$input = json_decode(file_get_contents('php://input'), true);
$hoy = date("Y-m-d H:i:s");

$card = isset($input["card"]) ? $input["card"] : 0;
$idcard = isset($input["idcard"]) ? $input["idcard"] : 0;
$idsale = isset($input["idsale"]) ? $input["idsale"] : -1;
$idsuc = isset($input["idsuc"]) ? $input["idsuc"] : 0;
$prods = isset($input["prods"]) ? $input["prods"] : [];
$fecha = isset($input["date"]) ? $input["date"] : 0;
$referencia = isset($input["referencia"]) ? $input["referencia"] : 0;
$especial = isset($input["especial"]) ? $input["especial"] : 0;

if($card == 0 || $idcard == 0 || $idsale == -1 || $idsuc == 0 || empty($prods))
{
    echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["msg" => "Servidor : Datos insuficientes para canje"]]); return;
}

if($fecha != $date_server)
{
    //echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["msg" => "Servidor : Fecha del sistema con el servidor no coinciden"]]); return;
}


//VALIDAMOS LOS PRODUCTOS SI EXISTEN
foreach ($prods as $key => $value) {
  $prods[$key] = ["precio" => $value["precio"], "cant" => $value["cant"], "name" =>$value["name"], "id" => $value["id"]];
}



$count_error = 0;

$importe = 0;
$puntos_canjeados = 0;
$puntos = 0;
$status = 0;

$sql = "SELECT puntos, status FROM tarjeta WHERE no_tarjeta = '".$card."' LIMIT 1;";
$response = $conexion->query($sql);
if(!$response){ echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Error en el servicio"]]); return; }
if($response->num_rows == 0){ echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Tarjeta no identificada"]]); return; }

while($row = $response->fetch_object()) { $puntos = $row->puntos; $status = $row->status; }


if($status == 0){
    echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "La tarjeta esta desactivada"]]); return;
}


$sql = "SELECT fecha_sucursal, create_at, update_at, idsucursal FROM tarjeta_bitacora  WHERE idtarjeta = '".$idcard."' AND idconcepto = 1  ORDER BY fecha_sucursal DESC LIMIT 1;";
$response = $conexion->query($sql);
$ultima_fecha = "";
while($row = $response->fetch_object()){ 
    $ultima_fecha = $row->fecha_sucursal; 
}

$numMeses = calcularMesesEntreFechas($ultima_fecha, $hoy);

if($numMeses >= EXPIRATION_MONTH)
{
    $sql = "UPDATE tarjeta SET puntos = 0 WHERE no_tarjeta = '".$card."' LIMIT 1";
    $conexion->query($sql);

    $sql = "INSERT INTO tarjeta_bitacora (puntos, total, fecha_sucursal, create_at, update_at, idtarjeta, idsucursal, idconcepto) VALUES ('".$puntos."', '0', '".$fecha."', '".$hoy."', '".$hoy."', '".$idcard."', '".$idsuc."', 3);";
    $conexion->query($sql);

    echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Los puntos de la tarjeta han expirado"]]); return;
}




foreach ($prods as $key => $value) {
  $importe += ($value["precio"]);
}



$sql = "SELECT points_for_money FROM config WHERE id = 1 LIMIT 1;";
$resultado =  $conexion->query($sql);
$points_for_money = 4;
while($row = $resultado->fetch_object())
{
    $points_for_money = $row->points_for_money;
}


$puntos_canjeados = round(($importe * $points_for_money), 0, PHP_ROUND_HALF_UP);
if($puntos_canjeados > $puntos){ echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Pintor con puntos insuficientes", "point_change" =>$puntos_canjeados, "points_card" => $puntos]]); return; }


$saldo_puntos = ($puntos - $puntos_canjeados);
$saldo_puntos = $saldo_puntos < 0 ? 0 : $saldo_puntos;


$conexion->autocommit(FALSE);

//OBTENEMOS EL ID DE LA TARJETA
$sql = "SELECT idtarjeta FROM tarjeta WHERE no_tarjeta = '".$card."' LIMIT 1";
$response = $conexion->query($sql);
$id_tarjeta = 0;
while($row = $response->fetch_object()){ $id_tarjeta = $row->idtarjeta; }
if($id_tarjeta == 0) { echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Error al obtener el identificador de la tarjeta"]]); return; }

//ACTUALIZAMOS PUNTOS DEL PINTOR
$sql = "UPDATE tarjeta SET puntos = '".$saldo_puntos."' WHERE idtarjeta = ".$id_tarjeta." AND no_tarjeta = '".$card."';";
$response = $conexion->query($sql);
if(!$response){ echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Error al realizar la operación en el servidor"]]); return; }

//SE registra el movimiento

$sql = "INSERT INTO tarjeta_bitacora (puntos, total, remision, fecha_sucursal, create_at, update_at, idtarjeta, idsucursal, idconcepto, referencia)VALUES (".$puntos_canjeados.", '".$importe."', '".$idsale."' , '".$fecha."', '".$hoy."', '".$hoy."', ".$id_tarjeta.",".$idsuc.", 2, '".$referencia."');";
if(!$conexion->query($sql)) { $count_error++; }
$id_bitacora = $conexion->insert_id;

foreach ($prods as $key => $value) {
  $precio = $value["precio"];
  $name = $value["name"];
  $cant = $value["cant"];

  $sql = "INSERT INTO tarjeta_bitacora_detalle VALUES (null, '".$cant."', '".$precio."', '".$name."', '".$hoy."', '".$hoy."', ".$id_bitacora.", ".$id_tarjeta.", ".$idsuc.");";
  if(!$conexion->query($sql)) { $count_error++; }

  // SOLAMENTE CUANDO SEA CANJE DE PRODUCTOS ESPECIALES
  if($especial == 1)
  {
     //Descontar productos ....
     $sql_upd = "UPDATE producto_canje SET cantidad = (cantidad - ".$cant.")  WHERE idproducto = '".$value["id"]."';";
     if(!$conexion->query($sql_upd)) { $count_error++; }
  }

}

if($count_error > 0)
{
  $conexion->rollback();
  echo json_encode(["code" => 200, "message" => "Accepted", "data" => ["status" => false, "msg" => "Error al realizar la operación en el servidor"]]); return;
}

$conexion->commit();
$conexion->autocommit(TRUE);

$puntos = $puntos - $puntos_canjeados;
if($puntos < 0) { $puntos = 0; }

$return = array("status" => true, "msg" => "Canje Correcto", "idventa"=> $idsale, "date"=>$fecha, "idcard" => $idcard, "card" => $card, "import"=>$importe, "point_change" =>$puntos_canjeados, "points_card" => $puntos,  "prods" => $prods, "referencia" => $referencia);

echo json_encode(["code" => 201, "message" => "Created", "data" => $return]);
return;
?>

<?php

  if( !$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $tipo = isset($_POST["tipo"]) ? trim($_POST["tipo"]) : null;
  $puntos = isset($_POST["puntos"]) ? trim($_POST["puntos"]) : null;
  $concepto = isset($_POST["concepto"]) ? trim($_POST["concepto"]) : null;
  $id_tarjeta = isset($_POST["id_tarjeta"]) ? trim($_POST["id_tarjeta"]) : null;

  if($tipo == null || ($tipo != 1 && $tipo != 2)){ echo json_encode(["code" => 200, "error" => ["El tipo de movimiento es incorrecto"]]); return; }
  if($puntos == null || !is_numeric($puntos) || $puntos < 0){ echo json_encode(["code" => 200, "error" => ["Los puntos ingresados son incorrectos"]]); return; }
  if($concepto == null || strlen($concepto) < 10){ echo json_encode(["code" => 200, "error" => ["El concepto es incorrecto (min 10 caracteres)"]]); return; }

  $concepto .= ", ".$_SESSION["datauser"]["name"];

  /* OBTENEMOS LOS DATOS DE LA TARJETA ACTUAL*/
  $model->id = $id_tarjeta;
  $card = $model->one();
  if(!$card || $card->num_rows == 0){ echo json_encode(["code" => 200, "error" => ["La tarjeta no ha sido identificada"]]); return; }

  $card = $card->fetch_object();

  if($tipo == 2 && $puntos > $card->puntos){ echo json_encode(["code" => 200, "error" => ["Los puntos a descontar son insuficientes"]]); return; }

  $puntos_final = $tipo == 1 ? ($card->puntos + $puntos) : ($card->puntos - $puntos);
  $puntos_final = ($puntos_final < 0) ? 0 : $puntos_final;

  $modelBitacora = new CardBitacora();
  $hoy = date("Y-m-d H:i:s");
  $importe_de_puntos = round(($puntos / 4), 0, PHP_ROUND_HALF_UP);

  $modelBitacora->puntos = $puntos;
  $modelBitacora->total = $importe_de_puntos;
  $modelBitacora->remision = 0;
  $modelBitacora->referencia = $concepto;
  $modelBitacora->fecha_sucursal = $hoy;
  $modelBitacora->create_at = $hoy;
  $modelBitacora->update_at = $hoy;
  $modelBitacora->idtarjeta = $id_tarjeta;
  $modelBitacora->idsucursal = 89;
  $modelBitacora->idconcepto = $tipo;
  if(!$modelBitacora->create()){ echo json_encode(["code" => 200, "error" => ["Movimiento no registrado"]]); return; }


  $model->update_t = $hoy;
  $model->puntos = $puntos_final;
  $response = $model->update();
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["error al crear el movimiento"];
  echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
  return;
?>

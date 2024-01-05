<?php
  if(!$permisos->Editar_Descuento){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $code = isset($_POST["code"]) ? $_POST["code"] : 0;
  $id = isset($_POST["id"]) ? trim($_POST["id"]) : 0;
  $discount = isset($_POST["discount"]) ? trim($_POST["discount"]) : 0;
  $fechini = isset($_POST["fechini"]) ? trim($_POST["fechini"]) : null;
  $fechfin = isset($_POST["fechfin"]) ? trim($_POST["fechfin"]) : null;

  if($code == null || strlen($code) == 0){ echo json_encode(["code" => 200, "error" => ["El codigo es incorrecto"]]); return; }
  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["La id del producto es incorrecto"]]); return; }
  if($discount == null || $discount < 0){ echo json_encode(["code" => 200, "error" => ["El descuento es incorrecto"]]); return; }

  if($fechini == null || strlen($fechini) == 0 || !validar_fecha_espanol($fechini)){ echo json_encode(["code" => 200, "error" => ["La fecha inicial es incorrecta"]]); return; }
  if($fechfin == null || strlen($fechfin) == 0 || !validar_fecha_espanol($fechfin)){ echo json_encode(["code" => 200, "error" => ["La fecha final es incorrecta"]]); return; }


  $update_at = date("Y-m-d H:i:s");
  $response = $model->update_discount($code, $id, $discount, $fechini, $fechfin, $update_at);

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al actualizar el descuento"];
  echo json_encode(["code" => $code, "error" => $error, "update_at" => fechaCortaAbreviadaConHora($update_at), "descuento" => number_format($discount, 2)]);
  return;
?>

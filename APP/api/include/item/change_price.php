<?php
  if(!$permisos->Editar_Precio){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $code = isset($_POST["code"]) ? $_POST["code"] : 0;
  $id = isset($_POST["id"]) ? trim($_POST["id"]) : 0;
  $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : 0;

  if($code == null || strlen($code) == 0){ echo json_encode(["code" => 200, "error" => ["El codigo es incorrecto"]]); return; }
  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["La id del producto es incorrecto"]]); return; }
  if($precio == null || $precio <= 0){ echo json_encode(["code" => 200, "error" => ["El precio es incorrecto"]]); return; }

  $update_at = date("Y-m-d H:i:s");
  $response = $model->update_price($code, $id, $precio, $update_at);

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al crear el producto"];
  echo json_encode(["code" => $code, "error" => $error, "update_at" => fechaCortaAbreviadaConHora($update_at), "precio" => number_format($precio, 2)]);
  return;
?>

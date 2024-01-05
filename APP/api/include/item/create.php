<?php
  if(!$permisosCanje->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $producto = isset($_POST["producto"]) ? trim($_POST["producto"]) : 0;
  $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : 0;
  $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : 0;

  if($producto == null || strlen($producto) == 0){ echo json_encode(["code" => 200, "error" => ["El producto es incorrecto"]]); return; }
  if($cantidad == null || $cantidad <= 0){ echo json_encode(["code" => 200, "error" => ["La cantidad es incorrecta"]]); return; }
  if($precio == null || $precio <= 0){ echo json_encode(["code" => 200, "error" => ["El precio es incorrecto"]]); return; }

  $response = $model->create($producto, $cantidad, $precio);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al crear el producto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

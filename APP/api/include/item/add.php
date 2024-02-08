<?php
  if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : 0;
  $barcode = isset($_POST["barcode"]) ? trim($_POST["barcode"]) : 0;
  $codigo_asociado = isset($_POST["codigo_asociado"]) ? trim($_POST["codigo_asociado"]) : "";
  $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : -1;
  $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : 0;
  $clave_sat = isset($_POST["clave_sat"]) ? trim($_POST["clave_sat"]) : 0;
  $es_base = isset($_POST["es_base"]) ? trim($_POST["es_base"]) : -1;
  $linea = isset($_POST["linea"]) ? trim($_POST["linea"]) : 0;
  $capacidad = isset($_POST["capacidad"]) ? trim($_POST["capacidad"]) : 0;
  $descuento = isset($_POST["descuento"]) ? trim($_POST["descuento"]) : -1;
  $fechini = isset($_POST["fechini"]) ? trim($_POST["fechini"]) : 0;
  $fechfin = isset($_POST["fechfin"]) ? trim($_POST["fechfin"]) : 0;
  $peso = isset($_POST["peso"]) ? trim($_POST["peso"]) : 0;
  $marca = isset($_POST["marca"]) ? trim($_POST["marca"]) : 0;

  if($codigo == null || strlen($codigo) == 0){ echo json_encode(["code" => 200, "error" => ["El codigo es incorrecto"]]); return; }
  //if($barcode == null){ echo json_encode(["code" => 200, "error" => ["El barcode es incorrecto"]]); return; }
  if($descripcion == null || strlen($descripcion) == 0){ echo json_encode(["code" => 200, "error" => ["La descripción es incorrecta"]]); return; }
  if($clave_sat == null || strlen($clave_sat) == 0){ echo json_encode(["code" => 200, "error" => ["La clave sat es incorrecta"]]); return; }
  if($precio == null || $precio < 0){ echo json_encode(["code" => 200, "error" => ["El precio es incorrecto"]]); return; }
  if($linea == null || $linea <= 0){ echo json_encode(["code" => 200, "error" => ["La linea es incorrecta"]]); return; }
  if($capacidad == null || $capacidad <= 0){ echo json_encode(["code" => 200, "error" => ["La capacidad es incorrecta"]]); return; }
  if($es_base == null || $es_base < 0){ echo json_encode(["code" => 200, "error" => ["El campo 'Es base' es incorrecto"]]); return; }
  if($descuento == null || $descuento < 0){ echo json_encode(["code" => 200, "error" => ["El descuento es incorrecto"]]); return; }
  if($fechini == null || strlen($fechini) == 0){ echo json_encode(["code" => 200, "error" => ["La fecha inicial es incorrecta"]]); return; }
  if($fechfin == null || strlen($fechfin) == 0){ echo json_encode(["code" => 200, "error" => ["La fecha final es incorrecta"]]); return; }
  if($peso == null || $peso < 0 || strlen($peso) == 0){ echo json_encode(["code" => 200, "error" => ["El peso es incorrecto"]]); return; }
  if($marca == null || $marca < 0){ echo json_encode(["code" => 200, "error" => ["El campo 'marca' es incorrecto"]]); return; }

  $duplicado = $model->getCountByCode($codigo);
  if($duplicado->total > 0){ echo json_encode(["code" => 200, "error" => ["El producto ya está registrado"]]); return; }

  $duplicado = $model->getCountByBarcode($barcode);
  if($duplicado->total > 0){ echo json_encode(["code" => 200, "error" => ["El código de barras ya está registrado"]]); return; }

  $sat = new ClaveSatModel();
  $sat->clave_sat = $clave_sat;
  $data = $sat->one();
  if(!$data || $data->num_rows == 0){  echo json_encode(["code" => 200, "error" => ["La Clave SAT ingresada no ha sido identificada"]]); return; }


  $precio_especial = 0;
  // Genera el UUID con uniqid
  $uuid_sync = uniqid('', true);
  $response = $model->add($codigo, $barcode, $descripcion, $clave_sat, $precio, $linea, $capacidad, $descuento, $fechini, $fechfin, $es_base, $precio_especial, $peso, $codigo_asociado, $marca, $uuid_sync);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al crear el producto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;

?>

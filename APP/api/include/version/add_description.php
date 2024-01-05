<?php
  if(!$permisos->Listado_de_Versiones->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? $_POST["id"] : 0;
  $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";

  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($descripcion == null || strlen($descripcion) == 0){ echo json_encode(["code" => 200, "error" => ["La descripción es incorrecta"]]); return; }

  $response = $model->adddetail($id, $descripcion);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al agregar la descripción"];

  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

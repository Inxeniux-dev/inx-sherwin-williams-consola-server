<?php
  if(!$permisos->Listado_de_Versiones->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $id = isset($_POST["id"]) ? $_POST["id"] : 0;
  $status = isset($_POST["status"]) ? trim($_POST["status"]) : "";

  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El estatus es incorrecto"]]); return; }

  $response = $model->updateStatus($id, $status);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al actualizar el estatus"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

<?php
  if(!$permisosCanje->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? trim($_POST["id"]) : 0;

  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }

  $response = $model->delete($id);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar el producto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

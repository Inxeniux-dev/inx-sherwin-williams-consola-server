<?php

  if( !$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }


  $id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
  $status = isset($_POST["status"]) ? trim($_POST["status"]) : null;

  if($id == null){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($status == null || ($status != 1 && $status != 0)){ echo json_encode(["code" => 200, "error" => ["El status es incorrecto"]]); return; }

  $status = $status == 1 ? 0 : 1;

  $response = $model->update_status($id, $status);
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["error al actualizar status"];
  echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
  return;


?>
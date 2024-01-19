<?php

  if(!$permisos->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? $_POST["id"] : 0;

  $response = $model->deleteItem($id);

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar el cliente"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

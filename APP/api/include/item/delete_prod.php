<?php

  if(!$permisosCanje->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : 0;
  $id = isset($_POST["id"]) ? $_POST["id"] : 0;

  $response = $model->deleteItem($codigo, $id);

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar el producto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

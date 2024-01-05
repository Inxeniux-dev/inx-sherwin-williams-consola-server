<?php
  $id = isset($_POST["id"]) ? $_POST["id"] : null;
  if($id == null || strlen($id) == 0){
    echo json_encode(["code" => 200, "error" => ["El id del usuario es incorrecto"]]); return;
  }

  $inhabilModel->id = $id;

  $response = $inhabilModel->delete();
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar fecha"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
  ?>

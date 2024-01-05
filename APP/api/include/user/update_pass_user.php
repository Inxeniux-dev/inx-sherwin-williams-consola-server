<?php
  if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["iduser"]) ? $_POST["iduser"] : null;
  $idsistema = isset($_POST["idsistema"]) ? $_POST["idsistema"] : type;
  $password = isset($_POST["password"]) ? $_POST["password"] : null;
  $repeatPassword = isset($_POST["repassword"]) ? $_POST["repassword"] : null;

  if($id == null || strlen($id) == 0 || !is_numeric($id) || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($idsistema == null || strlen($idsistema) == 0 || !is_numeric($idsistema) || $idsistema <= 0){ echo json_encode(["code" => 200, "error" => ["El tipo de usuario no se ha identificado"]]); return; }
  if($password == null || strlen($password) == 0){ echo json_encode(["code" => 200, "error" => ["El password es requerido"]]); return; }
  if($password != $repeatPassword){ echo json_encode(["code" => 200, "error" => ["El password no coincide"]]); return; }

  $model->id = $id;
  $model->password = $password;
  $model->id_sistema = $idsistema;
  $model->update_at = date('Y-m-d H:i:s');
  $response = $model->updatePassword();

  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al cambiar password"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

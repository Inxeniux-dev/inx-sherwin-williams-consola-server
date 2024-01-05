<?php
  if(!$permisos->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["iduser"]) ? $_POST["iduser"] : null;
  $idsistema = isset($_POST["idsistema"]) ? $_POST["idsistema"] : type;


  if($id == null || strlen($id) == 0 || !is_numeric($id) || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($idsistema == null || strlen($idsistema) == 0 || !is_numeric($idsistema) || $idsistema <= 0){ echo json_encode(["code" => 200, "error" => ["El tipo de usuario no se ha identificado"]]); return;}

  $model->id = $id;
  $model->id_sistema = $idsistema;
  $response = $model->delete();

  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al cambiar password"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

<?php
  if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $area = isset($_POST["area"]) ? trim($_POST["area"]) : null;
  $tipo_sistema = isset($_POST["tipo_sistema"]) ? trim($_POST["tipo_sistema"]) : 0;
  $id_user = isset($_POST["id_user"]) ? trim($_POST["id_user"]) : 0;

  if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return; }
  if($username == null || strlen($username) < 5){ echo json_encode(["code" => 200, "error" => ["El username es incorrecto o es necesario más de 5 carácteres"]]); return; }
  if($area == null || strlen($area) == 0 || !is_numeric($area) || $area <= 0){ echo json_encode(["code" => 200, "error" => ["El área es incorrecta"]]); return; }
  if($tipo_sistema == null || strlen($tipo_sistema) == 0 || !is_numeric($tipo_sistema) || $tipo_sistema <= 0){ echo json_encode(["code" => 200, "error" => ["El tipo de usuario es incorrecto"]]); return; }
  if($id_user == null || strlen($id_user) == 0 || !is_numeric($id_user) || $id_user <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }

  $model->username = $username;
  $model->id_sistema = $tipo_sistema;
  $duplicado = $model->getbyUsernameAndSistem();
  if(!$duplicado) { echo json_encode(["code" => 200, "error" => ["Error al validar username"]]); return; }
  if($duplicado->num_rows > 0){
      $user_db = $duplicado->fetch_object();
      if($user_db->iduser != $id_user)
      {
        echo json_encode(["code" => 200, "error" => ["El username ya está registrado"]]); return;
      }
  }



  $hoy = date("Y-m-d H:i:s");
  $model->nombre = $nombre;
  $model->username = $username;
  $model->tipo = $area;
  $model->update_at = $hoy;
  $model->permisos = $user_db->permisos;
  $model->id = $id_user;
  $response = $model->updateUser();
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al crear el usuario"];
  echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
  return;
?>

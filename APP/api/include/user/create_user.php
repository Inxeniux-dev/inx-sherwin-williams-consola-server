<?php
  if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
  $repeat_password = isset($_POST["repeat_password"]) ? trim($_POST["repeat_password"]) : null;
  $area = isset($_POST["area"]) ? trim($_POST["area"]) : null;
  $tipo_sistema = isset($_POST["tipo_sistema"]) ? trim($_POST["tipo_sistema"]) : 0;

  if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return; }
  if($username == null || strlen($username) < 5){ echo json_encode(["code" => 200, "error" => ["El username es incorrecto o es necesario más de 5 carácteres"]]); return; }
  if($password == null || strlen($password) <= 5){ echo json_encode(["code" => 200, "error" => ["El password es incorrecto o es necesario más de 5 carácteres"]]); return; }
  if($repeat_password == null || strlen($repeat_password) == 0){ echo json_encode(["code" => 200, "error" => ["El repeat password es incorrecto o es necesario más de 5 carácteres"]]); return; }
  if($area == null || strlen($area) == 0 || !is_numeric($area) || $area <= 0){ echo json_encode(["code" => 200, "error" => ["El área es incorrecta"]]); return; }
  if($password != $password) { echo json_encode(["code" => 200, "error" => ["El password no coincide"]]); return; }
  if($tipo_sistema == null || strlen($tipo_sistema) == 0 || !is_numeric($tipo_sistema) || $tipo_sistema <= 0){ echo json_encode(["code" => 200, "error" => ["El tipo de usuario es incorrecto"]]); return; }

  $model->username = $username;
  $model->id_sistema = $tipo_sistema;
  $duplicado = $model->getbyUsernameAndSistem($username);
  if(!$duplicado) { echo json_encode(["code" => 200, "error" => ["Error al validar username"]]); return; }
  if($duplicado->num_rows > 0){ echo json_encode(["code" => 200, "error" => ["El username ya está registrado"]]); return; }



  if($tipo_sistema == 2)
  {
      $permisos = $permisoService->generatePermissionSchemaPOS();
  }
  else if($tipo_sistema == 3)
  {
    $permisos = '';
  }
  else {
     $permisos = $permisoService->generatePermissionSchema();
  }


  $hoy = date("Y-m-d H:i:s");
  $model->nombre = $nombre;
  $model->username = $username;
  $model->password = $password;
  $model->tipo = $area;
  $model->id_sistema = $tipo_sistema;
  $model->create_at = $hoy;
  $model->update_at = $hoy;
  $model->permisos = json_encode($permisos);
  $response = $model->addUser();
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al crear el usuario"];
  echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
  return;
?>

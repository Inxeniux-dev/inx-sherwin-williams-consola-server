<?php
  if(!$permisos->Empleados->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $username = isset($_POST["username"]) ? $_POST["username"] : "";
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
  $add_pintor = isset($_POST["add_pintor"]) ? trim($_POST["add_pintor"]) : 0;
  $list_pintor = isset($_POST["list_pintor"]) ? trim($_POST["list_pintor"]) : 0;
  $add_user = isset($_POST["add_user"]) ? trim($_POST["add_user"]) : 0;
  $list_user = isset($_POST["list_user"]) ? trim($_POST["list_user"]) : 0;
  $idempleado = isset($_POST["idempleado"]) ? trim($_POST["idempleado"]) : 0;

  if($idempleado == null || $idempleado <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($username == null || strlen($username) == 0){ echo json_encode(["code" => 200, "error" => ["El username es incorrecto"]]); return; }
  if($password == null || strlen($password) == 0){ echo json_encode(["code" => 200, "error" => ["El password es incorrecto"]]); return; }

  $model->username = $username;
  $model->password = $password;
  $model->add_pintor = $add_pintor;
  $model->list_pintor = $list_pintor;
  $model->add_user = $add_user;
  $model->list_user = $list_user;
  $model->idempleado = $idempleado;
  $response = $model->update_permission();
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al actualizar el empleado"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>

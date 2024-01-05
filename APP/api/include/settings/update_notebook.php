<?php

$user_db = isset($_POST["user_db"]) ? $_POST["user_db"] : null;
$pass_db = isset($_POST["pass_db"]) ? $_POST["pass_db"] : null;
$host_db = isset($_POST["host_db"]) ? $_POST["host_db"] : null;
$port_db = isset($_POST["port_db"]) ? $_POST["port_db"] : null;
$name_db = isset($_POST["name_db"]) ? $_POST["name_db"] : null;

if($user_db == null || strlen($user_db) == 0){
  echo json_encode(["code" => 200, "error" => ["El user_db no es correcto"]]); return;
}
if($pass_db == null || strlen($pass_db) == 0){
  echo json_encode(["code" => 200, "error" => ["El pass_db no es correcto"]]); return;
}
if($host_db == null || strlen($host_db) == 0){
  echo json_encode(["code" => 200, "error" => ["El host_db no es correcto"]]); return;
}
if($port_db == null || strlen($port_db) == 0){
  echo json_encode(["code" => 200, "error" => ["El port_db es incorrecto"]]); return;
}
if($name_db == null || strlen($name_db) == 0){
  echo json_encode(["code" => 200, "error" => ["El name_db es incorrecto"]]); return;
}


$model->user_db_notebook = $user_db;
$model->pass_db_notebook = $pass_db;
$model->host_db_notebook = $host_db;
$model->port_db_notebook = $port_db;
$model->name_db_notebook = $name_db;

$response = $model->updateNotebook();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al actualizar información"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>

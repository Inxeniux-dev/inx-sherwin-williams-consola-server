<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }


$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
$objetivo = isset($_POST["objetivo"]) ? trim($_POST["objetivo"]) : null;

if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return; }
if($objetivo == null || strlen($objetivo) == 0 || $objetivo < 0){ echo json_encode(["code" => 200, "error" => ["El objetivo es requerido"]]); return; }

if($id == 1) { echo json_encode(["code" => 200, "error" => ["El vendedor no se puede editar"]]); return; }

$model->id = $id;
$model->nombre = strtoupper(trim($nombre));
$model->objetivo = trim($objetivo);

$response = $model->update();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al actualizar al vendedor"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
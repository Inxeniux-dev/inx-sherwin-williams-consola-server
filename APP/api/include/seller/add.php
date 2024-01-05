<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }


$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
$objetivo = isset($_POST["objetivo"]) ? trim($_POST["objetivo"]) : null;

if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return; }
if($objetivo == null || strlen($objetivo) == 0 || $objetivo < 0){ echo json_encode(["code" => 200, "error" => ["El objetivo es requerido"]]); return; }


$model->nombre = trim(strtoupper($nombre));
$model->objetivo = strtoupper(trim($objetivo));
$response = $model->create();

$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al crear el vendedor"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
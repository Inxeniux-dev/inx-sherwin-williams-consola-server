<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$marca = isset($_POST["marca"]) ? trim($_POST["marca"]) : null;
if($marca == null || strlen($marca) == 0){ echo json_encode(["code" => 200, "error" => ["La marca es requerida"]]); return; }

$model->marca = $marca;
$response = $model->add();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["error al crear la marca"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
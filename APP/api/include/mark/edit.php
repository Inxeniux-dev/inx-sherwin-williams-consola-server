<?php 

if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$marca = isset($_POST["marca"]) ? trim($_POST["marca"]) : null;
if($marca == null || strlen($marca) == 0){ echo json_encode(["code" => 200, "error" => ["La marca es requerida"]]); return; }
if($id == null || strlen($id) == 0 || $id == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["La marca no ha sido identificada"]]); return; }


$model->id = $id;
$model->marca = $marca;
$response = $model->update();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al actualizar la marca"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
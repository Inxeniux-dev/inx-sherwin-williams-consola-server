<?php 

if(!$permisos->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
if($id == null || strlen($id) == 0 || $id == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["El vendedor no ha sido identificado"]]); return; }
if($id == 1){ echo json_encode(["code" => 200, "error" => ["Este vendedor no se puede modificar"]]); return; }


$model->id = $id;
$response = $model->delete();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al eliminar vendedor"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
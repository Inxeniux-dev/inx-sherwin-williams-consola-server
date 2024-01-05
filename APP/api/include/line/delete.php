<?php 

if(!$permisos->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
if($id == null || strlen($id) == 0 || $id == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["La linea no ha sido identificada"]]); return; }


$item = new ItemModel();
$items = $item->countByMark($id);
if(!$items){  echo json_encode(["code" => 200, "error" => ["Error al validar linea"]]); return; }

$items = $items->num_rows > 0 ? $items->fetch_object()->total : 0;

if($items > 0)
{
   echo json_encode(["code" => 200, "error" => ["La linea tiene productos asociados"]]); return;
}


$model->id = $id;
$response = $model->delete();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al eliminar la linea"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
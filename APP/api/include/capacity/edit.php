<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$clave = isset($_POST["key"]) ? trim($_POST["key"]) : null;
$capacity = isset($_POST["capacity"]) ? trim($_POST["capacity"]) : null;
$tipo = isset($_POST["type"]) ? trim($_POST["type"]) : null;
$unidad = isset($_POST["unidad"]) ? trim($_POST["unidad"]) : null;


if($clave == null || strlen($clave) == 0 || !is_numeric($clave)){ echo json_encode(["code" => 200, "error" => ["La clave es incorrecta"]]); return; }
if($capacity == null || strlen($capacity) == 0){ echo json_encode(["code" => 200, "error" => ["La capacidad es requerida"]]); return; }
if($tipo == null || strlen($tipo) == 0){ echo json_encode(["code" => 200, "error" => ["El tipo es requerido"]]); return; }
if($unidad == null || strlen($unidad) == 0){ echo json_encode(["code" => 200, "error" => ["La unidad es requerida"]]); return; }


$model->id = $clave;
$capacityDB = $model->one();

if($capacityDB && $capacityDB->num_rows > 0)
{
	$idcapacity = $capacityDB->fetch_object()->idcapacidad;

	if($idcapacity != $id)
	{
		echo json_encode(["code" => 200, "error" => ["La capacidad ya está registrada"]]); return;
	}
}


$model->newId = $clave;
$model->id = $id;
$model->capacidad = strtoupper($capacity);
$model->tipo = $tipo;
$model->unidad = $unidad;

$response = $model->update();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["error al actualizar la capacidad"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }


$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$rfc = isset($_POST["rfc"]) ? trim($_POST["rfc"]) : null;
$proveedor = isset($_POST["proveedor"]) ? trim($_POST["proveedor"]) : null;

if($rfc == null || strlen($rfc) == 0){ echo json_encode(["code" => 200, "error" => ["El RFC es incorrecto"]]); return; }
if($proveedor == null || strlen($proveedor) == 0){ echo json_encode(["code" => 200, "error" => ["El proveedor es requerido"]]); return; }

$model->rfc = trim(strtoupper($rfc));
$supplerDB = $model->oneByRFC();

if($supplerDB && $supplerDB->num_rows > 0)
{
	$idSupplier = $supplerDB->fetch_object()->idproveedor;

	if($idSupplier != $id)
	{
		echo json_encode(["code" => 200, "error" => ["El RFC ya está registrado"]]); return;
	}
}

$model->id = $id;
$model->rfc = strtoupper(trim($rfc));
$model->razon_social = strtoupper($proveedor);

$response = $model->update();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["error al actualizar el proveedor"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
<?php 

if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$clave = isset($_POST["key"]) ? trim($_POST["key"]) : null;
$line = isset($_POST["linea"]) ? trim($_POST["linea"]) : null;
$tipo = isset($_POST["tipo"]) ? trim($_POST["tipo"]) : null;
$igualado = isset($_POST["igualado"]) ? trim($_POST["igualado"]) : null;
$conversion = isset($_POST["conversion"]) ? trim($_POST["conversion"]) : null;


if($clave == null || strlen($clave) == 0 || !is_numeric($clave)){ echo json_encode(["code" => 200, "error" => ["La clave es incorrecta"]]); return; }
if($line == null || strlen($line) == 0){ echo json_encode(["code" => 200, "error" => ["La linea es requerida"]]); return; }
if($tipo == null || strlen($tipo) == 0){ echo json_encode(["code" => 200, "error" => ["El tipo es requerido"]]); return; }
if($igualado == null || strlen($igualado) == 0){ echo json_encode(["code" => 200, "error" => ["Seleccione si es igualado"]]); return; }
if($conversion == null || strlen($conversion) == 0){ echo json_encode(["code" => 200, "error" => ["Seleccione si es para conversión"]]); return; }


$lineDb = $model->oneByID($clave);

if($lineDb && $lineDb->num_rows > 0)
{
	$idline = $lineDb->fetch_object()->idlinea;

	if($idline != $id)
	{
		echo json_encode(["code" => 200, "error" => ["La clave ya está registrada"]]); return;
	}
}

$model->new_id = $id;
$model->id = $clave;
$model->descripcion = strtoupper($line);
$model->tipo = $tipo;
$model->para_igualado = $igualado;
$model->para_conversion = $conversion;

$response = $model->update();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["error al actualizar línea"];
echo json_encode(["code" => $code, "error" => $error, "id" => $response]);
return;
?>
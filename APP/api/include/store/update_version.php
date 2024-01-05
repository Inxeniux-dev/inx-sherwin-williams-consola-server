<?php
if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; } 

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$version = isset($_POST["version"]) ? $_POST["version"] : 0;
$ip = isset($_POST["ip"]) ? $_POST["ip"] : 0;

if($id == null || $id <= 0 || $version == null || $version <= 0 || $ip == null || strlen($ip) == 0)
{
	echo json_encode(["code" => 200, "error" => ["Los datos ingresados son incorrectos"]]);  return;
}


$response = $model->updateVersion($id, $version, $ip);
$code = $response ? 201 : 200;
$error = $response ? [] : ["Error al actualizar los datos"];

if($response)
{

 if(file_exists(PATH_FILES_BACKUPS)) {

	if(!file_exists(PATH_FILES_BACKUPS."sucursal_".addCeros($id)))
	{
    	$file = mkdir(PATH_FILES_BACKUPS."sucursal_".addCeros($id), 0777, true);
	}
}

 	$response = $model->createDB($id);
	$model->upload_template($id);
	$model->update_clave($id);


	$stores = $model->getList();
	$service->genera_bat_uploads($stores);

}

echo json_encode(["code" => $code, "error" => $error]);
return;
?>

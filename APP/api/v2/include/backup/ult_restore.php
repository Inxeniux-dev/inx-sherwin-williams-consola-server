<?php
$config = new ConfigModel();
$config = $config->one();
if(!$config){ echo json_encode(["code"=> 501, "error" => ["Error al obtener las opciones de configuración"]]); return; }
$config = $config->fetch_object();

$datosRecibidos = file_get_contents("php://input");
$data = json_decode($datosRecibidos);
$data = $data->data;

$sucursal = isset($_GET["suc"]) ? $_GET["suc"] : 0;

$path = $config->path_backup.'sucursal_'.$sucursal;
if(file_exists($file)) {
  echo json_encode(["code" => 200, "status" => false, "msg" => "La sucursal no ha sido identificada", "error" => ["La sucursal no ha sido identificada"]]); return;
  //add_bitacora($data, $conexion, "Sucursal no ha sido identificada"); return;
}


$service = new BackupService();

$NAME = $file.'/respaldo_actual.gz';

$response = $service->DescomprimeBackup($path);
$response = $service->restoreBackup($sucursal, $path."/sucursal_".$sucursal.".sql");

if(!$response)
{
   echo json_encode(["code" => 200, "status" => false, "msg" => "La base de datos no se ha restaurado", "error" => ["La base de datos no se ha restaurado"]]); return;
   //add_bitacora($data, $conexion, "BD no restaurada"); return;
}

echo json_encode(["code" => 201, "status" => true, "msg" => "El respaldo ha sido actualizado correctamente", "error" => [""]]);  return;
//add_bitacora($data, $conexion, "Respaldo OK"); return;

?>

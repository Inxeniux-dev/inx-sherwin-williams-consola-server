<?php
$config = new ConfigModel();
$config = $config->one();
if(!$config){ echo json_encode(["code"=> 501, "error" => ["Error al obtener las opciones de configuración"]]); return; }
$config = $config->fetch_object();

$datosRecibidos = file_get_contents("php://input");

if(!$_POST["date_corte"]) { echo json_encode(["code"=> 501, "error" => ["Error al obtener la petición del archivo"]]); return; }

	$sucursal = $_POST["suc_name"];
	$corte = $_POST["date_corte"];
	$copy = isset($_POST["copy"]) ? $_POST["copy"] : true;

	if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK)
	{
  		$ruta_destino = $config->path_backup.$sucursal."/respaldo_actual.gz";

      if(!file_exists($config->path_backup.$sucursal))
      {
          if(!@mkdir($config->path_backup.$sucursal, 0777, true)) {  echo json_encode(["code"=> 501, "error" => ["Error al crear la carpeta del respaldo"]]); return; }
      }

  		$archivo_corte = $_FILES["archivo"]["tmp_name"];

  		$archivo_ok = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta_destino);

  		if(!$archivo_ok) { echo json_encode(["code"=> 200, "error" => ["Error al copiar el fichero a la ruta destino"]]); return; }

			if($copy)
			{
				$corte = str_replace("-", "", $corte);
				$ruta_destino2 = $config->path_backup.$sucursal."/".$sucursal."_".$corte."_".date('His').".gz";
				if (!@copy($ruta_destino, $ruta_destino2)) {
					 echo json_encode(["code"=> 501, "error" => ["Error al copiar el fichero a la ruta destino"]]); return;
				}
			}
	}
	else
	{
	   echo json_encode(["code"=> 501, "error" => ["Error al crear el archivo de respaldo"]]); return;
	}

  echo json_encode(["code"=> 201, "error" => ["Backup Creado Correctamente"]]); return;
?>


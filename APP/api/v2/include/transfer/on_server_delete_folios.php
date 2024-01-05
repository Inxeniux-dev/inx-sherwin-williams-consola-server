<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;


date_default_timezone_set("America/Mexico_City");

$datosRecibidos = file_get_contents("php://input");
$data = json_decode($datosRecibidos);

$folios = $data->folios;

if(empty($folios) || count($folios) == 0)
{
  	echo json_encode(array("code" => 200));
    return;
}

$dir = $PATH_TRANSFER;
foreach($folios as $key => $value)
{
		$name = $value->name;

		if(is_dir($dir)){
			  if(file_exists($dir.$name))
			  {
					if (copy($dir.$name, $dir."AGREGADOS\\".$name)) {
							unlink($dir.$name);
					}
			  }
        else {
            //crear la carpeta para eliminar el vale
        }
		}
}

echo json_encode(array("code" => 201));
return;

?>

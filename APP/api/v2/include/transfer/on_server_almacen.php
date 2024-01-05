<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;

$dir = $PATH_TRANSFER;

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){

  	$name = strtolower($file);

  	$pos = strpos($name, "xml");

	if ($pos === false) {} else {

		   $suc_env = substr($name, 0, 2);
                   $suc_rec = substr($name, 2, 2);
                   $fol_val = substr($name, 4);

		   	if (in_array($suc_rec, ALMACENES)) {
				   $xml=@simplexml_load_file($dir."\\".$name);
				   $folio_xml = abs($xml->data->folio);
				   $fecha = strval($xml->data->date_file);

					  $datos[] = array(
						"name" => $file,
						"receptor" => $suc_rec,
						"folio" => $folio_xml,
						"emisor" => $suc_env
				  );
		   }
		 }
    }
    closedir($dh);
  }
}

echo json_encode($datos);

?>

<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;

$name = isset($_GET["name"]) ? $_GET["name"] : null;

if($name != null ){
   $dir = $PATH_TRANSFER;
   if (is_dir($dir)){
     if ($dh = opendir($dir)){
       rename($dir."\\".$name, $dir."\\AGREGADOS\\".$name);
       closedir($dh);
     }
   }
   echo json_encode(array("code" => 200));
}


?>

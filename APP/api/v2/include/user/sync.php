<?php
$id_sistema = isset($_GET["id_sistema"]) ? $_GET["id_sistema"] : 0;
if($id_sistema <= 0){ echo json_decode([]); return; }


$sql = "SELECT * FROM user WHERE id_sistema = '".$id_sistema."';";
$response = $conexion->query($sql);

$lineas = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $lineas[] = $row;
  }
}

echo json_encode($lineas);
?>

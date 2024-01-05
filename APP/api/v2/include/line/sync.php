<?php

$sql = "SELECT * FROM linea;";
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

<?php

$sql = "SELECT points_for_money, points_percentage FROM config;";
$response = $conexion->query($sql);

$config = null;
if($response)
{
  while($row = $response->fetch_object())
  {
    $config = $row;
  }
}

echo json_encode($config);
return;
?>

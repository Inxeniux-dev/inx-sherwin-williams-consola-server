<?php

$sql = "SELECT * FROM vendedor;";
$response = $conexion->query($sql);

$sellers = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $sellers[] = $row;
  }
}

echo json_encode($sellers);
?>

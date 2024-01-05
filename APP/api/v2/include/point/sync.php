<?php

$sql = "SELECT idtarjeta, no_tarjeta, tarjeta.nombre, apellido, tarjeta.telefono, tarjeta.email, puntos, descuento, tarjeta.direccion, tarjeta.status, create_at, membresia, tarjeta.sucursal_alta,  CASE
WHEN tarjeta.sucursal_alta = 0 THEN 'MATRIZ'
ELSE sucursal.nombre
END AS sucursal_registro, tarjeta.status FROM tarjeta LEFT JOIN sucursal ON tarjeta.sucursal_alta = sucursal.idsucursal;";
$response = $conexion->query($sql);

$tarjetas = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $tarjetas[] = $row;
  }
}

echo json_encode($tarjetas);
return;
?>

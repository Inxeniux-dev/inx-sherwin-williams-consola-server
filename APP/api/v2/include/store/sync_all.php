<?php
$sql = "SELECT idsucursal, nombre, serie, almacen, direccion, num_interior, num_exterior, cp, colonia, pais, estado, ciudad, telefono, email, cruzamiento, status, version FROM c_server.sucursal;";
$response = $conexion->query($sql);

$sucursales = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $sucursales[] = $row;
  }
}

echo json_encode($sucursales);
return;
?>

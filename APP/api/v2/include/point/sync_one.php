<?php

$id_card = isset($_GET["id_card"]) ? $_GET["id_card"] : 0;
$time_init = date("Y-m-d H:i:s");

$sql = "SELECT idtarjeta, no_tarjeta, tarjeta.nombre, apellido, tarjeta.telefono, tarjeta.email, puntos, descuento, tarjeta.direccion, tarjeta.status, create_at, membresia, tarjeta.sucursal_alta,  CASE
WHEN tarjeta.sucursal_alta = 0 THEN 'MATRIZ'
ELSE sucursal.nombre
END AS sucursal_registro, tarjeta.status FROM tarjeta LEFT JOIN sucursal ON tarjeta.sucursal_alta = sucursal.idsucursal WHERE idtarjeta = '".$id_card."';";
$response = $conexion->query($sql);

$tarjetas = array();
if($response)
{
    while($row = $response->fetch_object())
    {
        $nombre = $row->nombre." ".$row->apellido;
        $nombre = str_replace("'", "", $nombre);
        $nombre = str_replace('""', '', $nombre);
        $nombre = str_replace(",", "", $nombre);

      echo json_encode(array("idcard"=> $row->idtarjeta, "tarjeta" => $row->no_tarjeta, "email" => $row->email, "no_tarjeta" => $row->no_tarjeta, "puntos" => $row->puntos, "nombre" => $nombre, "telefono" => $row->telefono, "direccion" => $row->direccion, "idtarjeta" => $row->idtarjeta, "status" => $row->status));
      return;
    }
}

echo json_encode([]);
return;
?>

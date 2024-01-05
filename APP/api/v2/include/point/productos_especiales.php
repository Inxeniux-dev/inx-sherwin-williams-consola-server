<?php

$sql = "SELECT idproducto, producto, precio, cantidad, status FROM producto_canje WHERE cantidad > 0;";
$response = $conexion->query($sql);

$prods = array();
if($response)
{
    while($row = $response->fetch_object())
    {
        $prods[] = array("id"=> $row->idproducto, "producto" => $row->producto, "precio" => $row->precio, "cantidad" => $row->cantidad);
    }
}

echo json_encode($prods);
return;
?>

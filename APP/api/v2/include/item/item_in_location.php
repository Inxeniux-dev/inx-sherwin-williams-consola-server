<?php

$code = isset($_GET["code"]) ? $_GET["code"] : '';

$sucursales = array();
$sql_sucursal = "SELECT idsucursal, nombre, version, almacen FROM c_server.sucursal;";
$response = $conexion->query($sql_sucursal);

while($row = $response->fetch_object())
{
   $sucursales[$row->idsucursal] = ["name" => $row->nombre, "version" => $row->version, "almacen" => $row->almacen, "id" => $row->idsucursal];
}

$sucursales_array = $sucursales;
$sucursales = json_decode(json_encode($sucursales));

$response = array();
if($sucursales)
{
    foreach ($sucursales as $key => $value) {

        $existencia = 0;
        if($value->almacen == 0)
        {
            $NAME_DB = "sucursal_".addCeros($value->id);

            if($value->version == 0)
            {
               /*  $sql = "SELECT arti_sald_act AS existencia FROM ".$NAME_DB.".articulo WHERE arti_cod = '".$code."' LIMIT 1;";
                $response_search = $conexion->query($sql);
                if($response_search)
                {
                    while($row_search = $response_search->fetch_object())
                    {
                        $existencia = $row_search->existencia;
                    }
                }*/
            }
            else
            {
               $sql = "SELECT existencia FROM ".$NAME_DB.".articulo WHERE codigo = '".$code."' LIMIT 1;";
                $response_search = $conexion->query($sql);
                if($response_search)
                {
                    while($row_search = $response_search->fetch_object())
                    {
                        $existencia = $row_search->existencia;
                    }
                }
            }

            if($existencia > 0)
            {
                $response[] = array("id" => $value->id, "location" => $value->name, "existencia" => $existencia);
            }
        }
    }
}


$data = json_decode(json_encode($response));

echo json_encode([$data]);
return;
?>

<?php

$identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
$type = isset($_POST["type"]) ? $_POST["type"] : 1;

if($identified == null || $identified == 0 || $type == null || $type == 0)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["Los datos son incorrectos"]]); return;
}

$data = $model->getDataOnlySaleByID($identified);

if($data == null || !$data)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["La venta no ha sido identificada"]]); return;
}

if($data->status != 1)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["El estatus de la venta es incorrecto"]]); return;
}


 $model = $model->changeData($identified, 7, $type);
 if(!$model){ echo json_encode(["code" => 200, "status" => false, "error" => ["Error al actualizar el descuento"]]); return; } 


 echo json_encode(["code" => 201, "status" => true, "error" => [""]]); return;

?>

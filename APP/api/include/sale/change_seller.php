<?php
    $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
    $id_seller = isset($_POST["id"]) ? $_POST["id"] : 0;

    if($identified == null || $identified == 0 || $id_seller == null || $id_seller == 0)
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

    $res = $model->update_seller($identified, $id_seller);

    if(!$res)
    {
      echo json_encode(["code" => 200, "status" => false, "error" => ["El agente no se ha actualizado"]]); return;
    }

    echo json_encode(["code" => 201, "status" => true, "msg" => "Agente actualizado correctamente"]); return;
?>

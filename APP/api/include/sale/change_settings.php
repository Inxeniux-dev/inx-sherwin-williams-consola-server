<?php

    $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
    $setting = isset($_POST["setting"]) ? $_POST["setting"] : 0;

    if($identified <= 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["El identificador de la venta es incorrecta"]]); return;
    }

    if($setting != 1 && $setting != 2)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["La configuración es incorrecta"]]); return;
    }


    $data_venta = $model->getData($identified);
    $count_pend = $model->getSalesPend($identified);

    if($count_pend > 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["Existe una venta en proceso, no es posible continuar"]]); return;
    }

    if($data_venta->status != 1)
    {
      echo json_encode(["code" => 200, "status" => false, "error" => ["No es posible cambiar de configuración, la venta ya esta finalizada"]]); return;
    }

    $response = $model->changeSetting($identified, $setting);
    $msg = $response ? "Configuración actualizada" : "La configuración no se actualizó.";

    echo json_encode(["code" => 200, "status" => true, "msg" => $msg, "error" => []]); return;
?>

<?php 

    $data = ["identified" => isset($_POST["identified"]) ? $_POST["identified"] : 0];

    $timeout = false;
    $errors = array();

    $return_service = new SaleServiceReturn();
    $validation = $return_service->valida_Cancelar_Venta($data, $model, $model_conversion);
    $errors = $validation;

    if(count($validation) > 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["No es posible realizar la devolución"], "validation" => $validation]); return;
    }

    $KEY = generaKeyQue();
    if($model_queue->setQueue($data["identified"], 15,  $KEY))
    {
        $codes_conversion_by_sale = $model_conversion->getCodesByIDSale($data["identified"]);
        $response = $model->addReturn($data, "cancel", $codes_conversion_by_sale, $KEY, $capaModel);
        
        if(!$response["save"])
        {
            $error = ["Error al finalizar la devolución"];
        }
        else {
            $msg = "Devolución finalizada";
        }
        if($response["cant_intentos"] > 1)
        {
            $error = ["Tiempo de espera agotado, intentalo nuevamente"];
        }
        if($response["beforequeue"] > 0)
        {
            $error = ["Existe una petición antes que esta, intentalo nuevamente"];
        }
  
         echo json_encode(["code" => 200, "status" => $response["save"], "msg" => $msg, "error" => $error, "info" => $response]);
         return;
    }

    echo json_encode(["code" => 200, "message" => "Success", "timeout" => $timeout, "errors" => $errors]);
    return;
?>
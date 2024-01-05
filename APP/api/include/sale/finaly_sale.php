<?php
    //Permisos del sistema
    if($_SESSION["config"]["bloqueo"] == 1) { echo json_encode(["code" => 200, "status" => false, "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

    if(!$_SESSION["permissions"][12]->status) {  echo json_encode(["code" => 200, "status" => false, "error" => ["No tienes permisos para realizar esta operación"]]); return; }
    //End Permisos del sistema

    if(!$_SESSION["config"]["unlok_system"])
    {
        if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
    }


    $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
    $cfdi_use = isset($_POST["cfdiuse"]) ? $_POST["cfdiuse"] : 0;

    $baseFromJavascript =  isset($_POST['base64']) ? $_POST['base64'] : null;


    if($baseFromJavascript != null)
    {

        if (!file_exists(PATH_SCREENSHOOT)) {
             mkdir(PATH_SCREENSHOOT, 0777, true);
        } 

        if (file_exists(PATH_SCREENSHOOT)) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
            $filepath = PATH_SCREENSHOOT."image_".$identified.".jpg"; // or image.jpg
            try {
                file_put_contents($filepath, $data);
            } catch (Exception $e) {
                    
            }
        }
    }



    if(strlen($identified) <= 0 || !is_numeric($identified) || $identified <= 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["Identificador de venta incorrecto"]]); return;
    }

    if(strlen($cfdi_use) < 3)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["Uso de CFDI incorrecto"]]); return;
    }

    $data_invent = $inventoryModel->getInventariesPend();
    if($data_invent != null && $data_invent->total > 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["Existe un inventario en proceso."]]); return;
    }

    $sale_service = new SaleService();

    $data = $model->getData($identified);
    $data_codes = $model->getProductListByIDWhitIguals($identified);
    $data_payment = $model->getPaymentsByID($identified);
    $discount = $model->getDescuentoMaximo($data->idtipo_descuento, null, $data->idcliente, $data->idpintor, $identified, null);
    $validation = $sale_service->validaFinalySale($data, $data_codes, $data_payment, $discount);



    if(empty($validation["error"]))
    {
        $KEY = generaKeyQue();
        if($model_queue->setQueue($identified, 1, $KEY))
        {
            echo json_encode($model->finalySale($identified, $data, $data_codes, $data_payment, $discount, $capaModel, $KEY));
            return;
        }
        else
        {
            echo json_encode(array("TIME_OUT" => true, "error" => []) );
            return;
        }
    }

    echo json_encode( array("TIME_OUT" => false, "error" => $validation["error"]) );
?>

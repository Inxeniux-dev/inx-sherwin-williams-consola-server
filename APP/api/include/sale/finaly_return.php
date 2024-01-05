<?php

    if(!$_SESSION["permissions"][48]->status) {
        echo json_encode(["code" => 200, "status" => false, "error" => ["No tienes permisos para realizar esta operación"]]);
        return;
    }

    if($_SESSION["config"]["bloqueo"] == 1) { echo json_encode(["code" => 200, "status" => false, "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

    if(!$_SESSION["config"]["unlok_system"])
    {
        if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
    }


  $data = [
      "products" => isset($_POST["products"]) ? $_POST["products"] : null,
      "identified" => isset($_POST["identified"]) ? $_POST["identified"] : 0,
      "ammount" => isset($_POST["ammount"]) ? $_POST["ammount"] : 0
  ];

    $return_service = new SaleServiceReturn();
    $validation = $return_service->addReturnValidation($data, $model);

    if($validation["errors"] != null)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["No es posible realizar la devolución"]]); return;
    }


    $KEY = generaKeyQue();
    if($model_queue->setQueue($_POST["identified"], 14, $KEY))
    {
      $codes_conversion_by_sale = $model_conversion->getCodesByIDSale($data["identified"]);
      $response = $model->addReturn($data, "devolution", $codes_conversion_by_sale, $KEY, $capaModel);

      $msg = "";
      $error = [];
      if(!$response["save"])
      {
          $error = ["Error al realizar la devolución"];

          if(!$response["import"])
          {
            $error = ["El importe de los productos es diferente al importe de la devolución"];
          }
      }
      else {
          $msg = "Devolución Finalizada";
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

    echo json_encode(array("save" => false, "error" => ["Tiempo de espera excedido, intentalo nuevamente"]));
    return;
?>

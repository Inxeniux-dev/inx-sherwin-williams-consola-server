<?php

    $serviceSaleItems = new SaleServiceAddItems();
    $itemModel = new ItemModel();

    $data = [
        "item" => isset($_POST["item"]) ? trim($_POST["item"]) : '',
        "identified" => isset($_POST["identified"]) ? trim($_POST["identified"]) : 0,
        "id_code" => isset($_POST["id_code"]) ? trim($_POST["id_code"]) : 0,
        "edit" => isset($_POST["edit"]) ? trim($_POST["edit"]) : false,
    ];



    $res = $serviceSaleItems->item_validateAddCode($data);  /* Validamos los datos del POST */
    if($res["validation"] == false)
    {
        echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => $res["error"]]);
        return;
    }

    $dataSale = $model->getDataOnlySaleByID($_POST["identified"]); /* Verificamos venta si existe */
    if($dataSale == NULL)
    {
      echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["La venta no ha sido identificada"]]);
      return;
    }

    if($dataSale->status != 1)  /* El status tiene que ser 1 por que esta pendiente por finalizar */
    {
        echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["La venta ya ha sido finalizada"]]);
        return;
    }


    $codigo = $data["item"];
    $pos = strpos($codigo, "*");
    if ($pos !== false)
    {
        $position = explode("*", $codigo);
        $codigo = $position[0];
    }

    $data_code = $itemModel->getDataCode($codigo);  /* Verificar que el código exista */
    if($data_code == NULL)
    {
      echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["El código ingresado no existe"]]);
      return;
    }


    $venta = to_object($dataSale);
    $discount = $model->getDescuentoMaximo($venta->idtipo_descuento, $codigo, $venta->idcliente, $venta->idpintor, $venta->idventa, null);
    if($discount > 5)
    {
      if($data_code->tipo == 2)
      {
          $discount = 0;
      }
    }

    if($venta->idtipo_descuento == 5)
    {
      $discount = 0;
    }

    $response = $model->item_addCode($data, $data_code, $dataSale, $discount);

    echo json_encode(["code" => 201, "status" => $response, "message" => "Success", "msg" => "", "error" => ["El producto no se ha agregado"]]);
    return;
 ?>

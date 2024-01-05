<?php
    $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
    $id = isset($_POST["id"]) ? $_POST["id"] : 0;
    $action = isset($_POST["action"]) ? $_POST["action"] : 0;


    if($action == 1)
    {
         if(!isset($_SESSION['permissions'][72]) || !$_SESSION['permissions'][72]->status)
         {
            echo json_encode(["code" => 200, "status" => false, "msg" => "No tienes permiso para realizar esta operación", "error" => ["No tienes permiso para realizar esta operación"]]); return;
         }
    }

    if($identified == null || $identified == 0 || $id == null || $id == 0)
    {
        echo json_encode(["code" => 200, "status" => false, "msg" => "Los datos son incorrectos", "error" => ["Los datos son incorrectos"]]); return;
    }

    $data = $model->getDataOnlySaleByID($identified);

    if($data == null || !$data)
    {
        echo json_encode(["code" => 200, "status" => false, "msg" => "La venta no ha sido identificada",  "error" => ["La venta no ha sido identificada"]]); return;
    }

    if($data->status != 0)
    {
        echo json_encode(["code" => 200, "status" => false, "msg" => "El estatus de la venta es incorrecto", "error" => ["El estatus de la venta es incorrecto"]]); return;
    }

    if($action != 1)
    {
        if(strlen($data->folio_factura) > 0)
        {
            echo json_encode(["code" => 200, "status" => false, "msg" => "La venta ya ha sido facturada", "error" => ["La venta ya ha sido facturada"]]); return;
        }
    }

    if($data->idtipo_de_venta == 2)
    {
        echo json_encode(["code" => 200, "status" => false, "msg" => "La venta es a crédito, no se puede realizar el cambio del uso de cdfi",  "error" => ["La venta es a crédito, no se puede realizar el cambio del uso de cdfi"]]); return;
    }

    $res = $model->update_CDFI($identified, $id);

    if(!$res)
    {
      echo json_encode(["code" => 200, "status" => false, "msg" => "El suso del CFDI no se ha actualizado", "error" => ["El suso del CFDI no se ha actualizado"]]); return;
    }

    echo json_encode(["code" => 201, "status" => true, "msg" => "Uso de CFDI actualizado correctamente"]); return;
?>

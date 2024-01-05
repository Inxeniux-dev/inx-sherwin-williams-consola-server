<?php

$identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;
$response  = array("error" => ["La venta ya ha sido finalizada, no es posible cancelar"], "status" => false);

$data_venta = $model->getData($identified);

if($data_venta->status != 1)
{
      echo json_encode(["code" => 200, "status" => false, "error" => ["La venta no se puede cancelar debido a que ya se ha finalizado"]]); return;
}

 $response = $model->cancel($identified, $data_venta->idtipo_de_documento);
 $documento = $data_venta->idtipo_de_documento == 1 ? "Remisión" : "Cotización";
 $msg = $response["save"] ? $documento." Cancelada" : "";
 echo json_encode(["code" => 200, "status" => $response["save"], "msg" => $msg, "error" => [$documento." no cancelada"]]); return;


?>

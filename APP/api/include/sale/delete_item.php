<?php


  $code =  isset($_POST["code"]) ? trim($_POST["code"]) : 0;
  $idproduct =  isset($_POST["id_code"]) ? trim($_POST["id_code"]) : 0;
  $identified =  isset($_POST["identified"]) ? trim($_POST["identified"]) : 0;

  $data_venta = $model->getDataOnlySaleByID($identified);

  if($data_venta == NULL)
  {
    echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["La venta no ha sido identificada"]]);
    return;
  }

  if($data_venta->status != 1)  /* El status tiene que ser 1 por que esta pendiente por finalizar */
  {
      echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["La venta ya ha sido finalizada"]]);
      return;
  }

  $response =  $model->deleteItemForList($identified, $code, $idproduct, $data_venta);

  echo json_encode(["code" => 201, "status" => $response, "message" => "Success", "msg" => "", "error" => ["El código no se ha eliminado"]]);
  return;

?>

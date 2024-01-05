<?php

$serviceSaleItems = new SaleServiceAddItems();
$itemModel = new ItemModel();

$data = [
    "item" => isset($_POST["item"]) ? trim($_POST["item"]) : '',
    "identified" => isset($_POST["identified"]) ? trim($_POST["identified"]) : 0,
    "discount" => isset($_POST["discount"]) ? trim($_POST["discount"]) : 0,
    "id_code" => isset($_POST["id_code"]) ? trim($_POST["id_code"]) : 0,
    "is_points" => isset($_POST["is_points"]) ? trim($_POST["is_points"]) : false,
];


$res = $serviceSaleItems->item_validateAddDiscount($data);  /* Validamos los datos del POST */
if($res["validation"] == false)
{
    echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => $res["error"]]);
    return;
}

$dataSale = $model->getDataOnlySaleByID($data["identified"]); /* Verificamos venta si existe */
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

$response = $model->item_whitDiscount($data);
if(!$response)
{
  echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["Error al actualizar el descuento"]]);
  return;
}

$count = 0;

if(strtoupper($data["item"]) != "IGUALCC"  && strtoupper($data["item"]) != "IGUALMA")
{
  $count = $response->fetch_object()->count;
  if($count > 0)
  {
    echo json_encode(["code" => 200, "message" => "Success", "msg" => "", "error" => ["Ya existe el código en la lista con el descuento ingresado"]]);
    return;
  }
}

$response = $model->item_addDiscount($data);

echo json_encode(["code" => 201, "status" => $response, "message" => "Success", "msg" => "", "error" => ["El descuento no se ha actualizado"]]);
return;

?>

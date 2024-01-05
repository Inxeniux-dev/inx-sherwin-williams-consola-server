<?php
$folio = isset($_POST["folio"]) ? $_POST["folio"] : 0;
$model_sale = new saleModel();
$res = $model_sale->getDataByFolio($folio);

if($res == null)
{
  echo json_encode(["code" => 200, "status" => true, "res" => $res,  "error" => ["La remisión no existe"], "msg" => ""]);
  return;
}

$prods = $model_sale->getProductListByID($res->idventa);

if(!$prods || $prods->num_rows == 0)
{
  echo json_encode(["code" => 200, "status" => true, "res" => $res,  "error" => ["Productos no encontrados"], "msg" => ""]);
  return;
}

$items = null;
while($row = $prods->fetch_object())
{
    if($row->descuento >= 99.99)
    {
      $items [] = array("codigo" => $row->codigo, "descripcion" => $row->descripcion, "cantidad" => $row->cantidad, "id" => $row->idventaproducto, "precio" =>$row->precio);
    }
}

if(empty($items))
{
  echo json_encode(["code" => 200, "status" => true, "res" => $res,  "error" => ["La remisión no tiene productos con un descuento autorizado para canje de puntos"], "msg" => ""]);
  return;
}

echo json_encode(["code" => 201, "status" => true, "items" => $items,  "error" => [], "msg" => "Ok"]);
return;

?>

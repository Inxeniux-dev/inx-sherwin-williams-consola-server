<?php

if(!$_SESSION["permissions"][54]->status) {
    echo json_encode(["code" => 200, "status" =>false, "message" => "No tienes permisos para realizar esta operación", "error" => ["No tienes permisos para realizar esta operación"]]); return;
}

if($_SESSION["config"]["bloqueo"] == 1) {
  echo json_encode(["code" => 200, "status" => false, "message" => "Ya se ha generado el reporte del cierre del día", "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

if(!$_SESSION["config"]["unlok_system"])
{
    if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "message" => "La fecha del corte no coincide con la fecha del sistema",  "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
}



$transferModel = new TransferModel();
$capaModel = new CapaModel();

$id = isset($_POST["id"]) ? $_POST["id"] : 0;

if($id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); }
$response = $itemModel->getDataAppliedByID($id);
if(!$response){ echo json_encode(["code" => 200, "status" =>false, "error" => ["Error al identificar el código para aplicar"]]); }
if($response->num_rows == 0){ echo json_encode(["code" => 200, "status" =>false, "error" => ["El código ya ha sido aplicado"]]); }

$productoList = array();

$conexion->autocommit(FALSE);
$error = array();
$codigo = "";
while($row = $response->fetch_object())
{
      $costo = ($row->precio / 2);

      $codigo = $row->codigo;

      $productoList[] = array(
          "codigo" => $row->codigo,
          "cantidad" => $row->por_aplicar,
          "movimiento" => 24,
          "existencia" => $row->existencia,
          "precio" => $row->precio,
          "identified" => $row->idventa,
          "costo" => $costo,
          "cantidad_a_descontar" => $row->por_aplicar,
          "entrada_o_salida" => 0,
          "no_aplicados" => 0,
          "capa" => 0,
          "descripcion" => $row->descripcion
      );
}


$status = false;
$msg = "";
$response = $transferModel->setApplied($productoList, $capaModel, $conexion, $id);
if(!empty($response))
{
    foreach ($response["error"] as $key => $value) {
        array_push($error, $value);
    }
}
if(!empty($error)){
    $conexion->rollback();
}
else{
     if(!$conexion->commit()){array_push($error, "Error al confirmar la operación");} else{ $status = true; }
}

if($status){ $msg = "Producto ".$codigo." Aplicado Correctamente"; }

echo json_encode(["code" => 200, "status" => $status, "msg"=> $msg, "error" => $error, "data" => $productoList]);
return;

?>

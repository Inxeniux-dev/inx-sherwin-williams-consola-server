<?php
  if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? trim($_POST["id"]) : 0;
  $date = isset($_POST["date"]) ? trim($_POST["date"]) : null;

  if($id <= 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "status" => false, "error" => ["El identificador es incorrecto"]]); return; }
  if(strlen($date) < 10){ echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha es incorrecta"]]); return; }
  if($date > date("Y-m-d")){ echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha de pago no debe ser mayor a la fecha actual"]]); return; }


  $invoice = new InvoiceModel();
  $invoice->id = $id;
  $invoice->fecha_pago = $date;
  $invoice->update_at = date('Y-m-d H:i:s');
  $response = $invoice->update();

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al registrar la fecha de pago"];
  echo json_encode(["code" => $code, "error" => $error, "date" => fechaCortaAbreviada($date)]);
  return;
?>

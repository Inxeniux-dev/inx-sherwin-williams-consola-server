<?php 

if(!$permisos->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
if($id == null || strlen($id) == 0 || $id == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["El proveedor no ha sido identificado"]]); return; }


$invoice = new InvoiceModel();
$invoice->idproveedor = $id;
$invoices = $invoice->countBySupplier();
if(!$invoices){  echo json_encode(["code" => 200, "error" => ["Error al validar proveedor"]]); return; }

$invoices = $invoices->num_rows > 0 ? $invoices->fetch_object()->total : 0;

if($invoices > 0)
{
   echo json_encode(["code" => 200, "error" => ["El proveedor tiene facturas asociados"]]); return;
}


$model->id = $id;
$response = $model->delete();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al eliminar proveedor"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>
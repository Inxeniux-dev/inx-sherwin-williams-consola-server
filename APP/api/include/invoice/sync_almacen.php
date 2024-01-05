<?php
if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$settingModel = new SettingModel();
$data_config = $settingModel->one();
require "../dao/ConexionAlmacen.php";

$fecha = date('Y-m-d');
$nuevafecha = strtotime ('-1 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$error = 0;


//Almacenes asignados al usuario logueado
$almacen = new AlmacenLibretaModel();
$almacen->iduser = $_SESSION["datauser"]["iduser"];
$almacen = $almacen->getListByUser();
if(!$almacen) { echo json_encode(["code" => 501, "status" => false, "error" => ['Ha ocurrido un error en el servidor']]); return; }
if($almacen->num_rows == 0){ echo json_encode(["code" => 200, "status" => false, "error" => ['El usuario logueado no tiene almacenes asignados']]); return; }

$almacenes = array();
while($row = $almacen->fetch_object())
{
   $almacenes[] = $row;
}

$invoice = new InvoiceModel();

foreach ($almacenes as $key => $value) {

  $sql = "SELECT folio, serie, factura, otrosgastos, total, iva, CostoProveedor, PrecioCorrecto, fecha_factura, fecha_captura, tipo_factura, id_proveedor FROM sucursal_".$value->clave.".compra WHERE status='OK' AND fecha_captura >= '".$nuevafecha."';";
  $res = $conexion_almacen->query($sql);
	while($row = $res->fetch_object())
	{
            $sql_count = "SELECT COUNT(*) AS total FROM factura_proveedor WHERE factura='".trim($row->factura)."' AND idproveedor=".$row->id_proveedor." AND folio = '".$row->folio."';";
            $res_count = $conexion->query($sql_count);
            if($res_count)
						{
                $count = $res_count->fetch_object()->total;

                if($count == 0 )
								{
                    $invoice->folio = $row->folio;
                    $invoice->serie = $row->serie;
                    $invoice->factura = $row->factura;
                    $invoice->otros_gastos = $row->otrosgastos;
                    $invoice->subtotal = $row->CostoProveedor;
                    $invoice->iva = $row->iva;
                    $invoice->total_costo = $row->total;
                    $invoice->total_venta = $row->PrecioCorrecto;
                    $invoice->fecha_factura = $row->fecha_factura;
                    $invoice->fecha_corte = $row->fecha_captura;
                    $invoice->tipo_factura = $row->tipo_factura;
                    $invoice->idproveedor = $row->id_proveedor;
                    $invoice->idalmacen = $value->idalmacen;
                    $invoice->create_at = date("Y-m-d H:i:s");
                    $invoice->update_at = date("Y-m-d H:i:s");
                    if(!$invoice->create()){ $error++; }
								}
            }
  }

}


function obtieneIdProveedor($proveedor, $clave_almacen)
{
    if($clave_almacen == "02" || $clave_almacen == "70")
    {
        if($proveedor == 1){  return 1; }
        if($proveedor == 12){  return 2; }
        if($proveedor == 21){  return 16; }
        if($proveedor == 22){  return 3; }
        if($proveedor == 23){  return 4; }
        if($proveedor == 24){  return 5; }
        if($proveedor == 25){  return 6; }
        if($proveedor == 26){  return 7; }
        if($proveedor == 27){  return 18; }
        return 17;
    }
    if($clave_almacen == "06")
    {
        if($proveedor == 1){  return 1; }
        if($proveedor == 10){  return 8; }
        if($proveedor == 12){  return 9; }
        if($proveedor == 13){  return 10; }
        if($proveedor == 14){  return 11; }
        if($proveedor == 15){  return 12; }
        if($proveedor == 17){  return 13; }
        if($proveedor == 20){  return 14; }
        if($proveedor == 21){  return 15; }
        if($proveedor == 22){  return 3; }
        if($proveedor == 23){  return 6; }
        if($proveedor == 24){  return 18; }

        return 17;
    }
    if($clave_almacen == "21")
    {
        if($proveedor == 1){  return 1; }
        if($proveedor == 10){  return 8; }
        if($proveedor == 12){  return 9; }
        if($proveedor == 13){  return 10; }
        if($proveedor == 14){  return 11; }
        if($proveedor == 15){  return 12; }
        if($proveedor == 17){  return 13; }
        if($proveedor == 18){  return 3; }
        if($proveedor == 19){  return 18; }
        return 17;
    }

    return 17;
}


$status = $error > 0 ? false : true;
$code = $status ? 201 : 200;
$error = $status ? [] : ["Existen algunos errores al sincronizar"];

echo json_encode(["code" => $code, "status" => $status, "error" => $error]);
?>

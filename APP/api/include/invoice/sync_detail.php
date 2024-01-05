<?php

  $id = isset($_GET["id"]) ? trim($_GET["id"]) : 0;
  $doc = isset($_GET["doc"]) ? trim($_GET["doc"]) : 0;
  $factura = isset($_GET["factura"]) ? trim($_GET["factura"]) : 0;
  $idalmacen = isset($_GET["idalmacen"]) ? trim($_GET["idalmacen"]) : 0;

  $settingModel = new SettingModel();
  $data_config = $settingModel->one();

  require "../dao/ConexionAlmacen.php";
  require "../models/AlmacenModel.php";

  $almacen = new AlmacenModel();
  $almacen->id = $idalmacen;
  $almacen = $almacen->one();
  if(!$almacen || $almacen->num_rows == 0){ echo json_encode(["code" => 200, "status" => false, "error" => ["Error al obtener el detalle del almacén"], "output" => '']); return; }
  $almacen = $almacen->fetch_object();

  $invoice = new InvoiceModel();
  $invoice->id = $id;
  $data = $invoice->one();
  if(!$data || $data->num_rows == 0){ echo json_encode(["code" => 200, "status" => false, "error" => ["Error al obtener el detalle de la factura"], "output" => '']); return; }
  $factura = $data->fetch_object();

  $sql = "SELECT id FROM sucursal_".addCeros($almacen->clave).".compra WHERE factura = '".$factura->factura."' LIMIT 1;";
  $res = $conexion_almacen->query($sql);
  if(!$res || $res->num_rows == 0){ echo json_encode(["code" => 200, "status" => false, "error" => ["Error al sincronizar con el almacén 1"], "output" => '']); return; }
  $factura_remota = $res->fetch_object();

  $sql = "SELECT codigo, paquete, cantidad, precio AS costo, precio_venta AS precios, arti_descrip AS descripcion FROM sucursal_".addCeros($almacen->clave).".compra_productos LEFT JOIN sucursal_".addCeros($almacen->clave).".articulo ON compra_productos.codigo = articulo.arti_cod WHERE id_compra = ".$factura_remota->id." ORDER BY codigo ASC;";
  $res = $conexion_almacen->query($sql);
  if(!$res){ echo json_encode(["code" => 200, "status" => false, "error" => ["Error al sincronizar con el almacén"], "output" => '']); return; }

  $output = '<table class="table table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th style="text-align:right;">Cantidad</th>
                        <th style="text-align:right;">Paquete</th>
                        <th style="text-align:right;">Costo Unitario</th>
                        <th style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>';
  $subtotal_capturado = 0;
  while($row = $res->fetch_object())
  {

      $cantidad_total = $row->paquete > 0 ? ($row->cantidad * $row->paquete) : $row->cantidad;
      $subtotal = ($cantidad_total * $row->costo);
      $subtotal_capturado += $subtotal;

      $output .= '<tr>
                      <td><b>'.$row->codigo.'</b><br>'.$row->descripcion.'</td>
                      <td align = "right">'.$row->cantidad.'</td>
                      <td align = "right">'.$row->paquete.'</td>
                      <td align = "right">$'.number_format($row->costo, 2).'</td>
                      <td align = "right">$'.number_format($subtotal, 2).'</td>
                  </tr>';
  }

  $subtotal = ($subtotal_capturado + $factura->otros_gastos);
  $iva = ($subtotal * 0.16);
  $total_captura =  ($subtotal + $iva);

  $output .= '<tr>
                  <td colspan = "4" align = "right"><b>Subtotal Capturado:</b></td>
                  <td align = "right"><b>$'.number_format($subtotal_capturado, 2).'</b></td>
              </tr>
              <tr>
                  <td colspan = "4" align = "right"><b>Otros Gastos:</b></td>
                  <td align = "right"><b>$'.number_format(($factura->otros_gastos), 2).'</b></td>
              </tr>
              <tr>
                  <td colspan = "4" align = "right"><b>Subtotal:</b></td>
                  <td align = "right"><b>$'.number_format($subtotal, 2).'</b></td>
              </tr>
              <tr>
                  <td colspan = "4" align = "right"><b>IVA:</b></td>
                  <td align = "right"><b>$'.number_format(($iva), 2).'</b></td>
              </tr>
              <tr>
                  <td colspan = "4" align = "right" style = "font-size:15px;"><b>Total Capturado en Artículos:</b></td>
                  <td align = "right" style = "font-size:15px;"><b>$'.number_format($total_captura, 2).'</b></td>
              </tr>
              <tr>
                  <td colspan = "4" align = "right" style = "font-size:15px;"><b>Total Factura:</b></td>
                  <td align = "right" style = "font-size:15px;"><b>$'.number_format(($factura->total_costo), 2).'</b></td>
              </tr>
            </tbody>
        </table>';

echo json_encode(["code" => 201, "status" => true, "error" => [], "output" => $output]); return;
?>

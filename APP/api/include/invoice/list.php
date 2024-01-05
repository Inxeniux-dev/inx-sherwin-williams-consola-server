<?php

$fechini = isset($_GET["fechini"]) ? trim($_GET["fechini"]) : date('Y-m-d');
$fechfin = isset($_GET["fechfin"]) ? trim($_GET["fechfin"]) : date('Y-m-d');
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$proveedor = isset($_GET["proveedor"]) ? $_GET["proveedor"] : 0;
$almacen = isset($_GET["almacen"]) ? $_GET["almacen"] : 0;
$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : 0;
$estatus = isset($_GET["estatus"]) ? $_GET["estatus"] : 0;

$page = isset($_GET["page"]) ? $_GET["page"] : 1;


$invoice = new InvoiceModel();
$invoice->search = $search;
$invoice->idalmacen = $almacen;
$invoice->idproveedor = $proveedor;
$invoice->fechini = $fechini;
$invoice->fechfin = $fechfin;
$invoice->page = $page;
$invoice->estatus = $estatus;
$invoice->tipo_factura = $tipo;
$data = $invoice->all();

$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output = '<table class = "table table-hover table-striped">
              <thead>
                  <th>#</th>
                  <th>Fecha Corte</th>
                  <th>Fecha Factura</th>
                  <th style = "text-align:right">Doc</th>
                  <th style = "text-align:right">Serie</th>
                  <th style = "text-align:right">Factura</th>
                  <th style = "text-align:right">Total Factura</th>
                  <th style = "text-align:right">Entrada</th>
                  <th style = "text-align:right">Fecha Pago</th>
                  <th style = "text-align:right">Márgen</th>
                  <th></th>
                  <th style = "text-align:center"><i class="fas fa-info-circle" title = "Ver detalle"></i></th>
              </thead>
              <tbody>';


        $cont = 0;

        while($row = $data["facturas"]->fetch_object())
        {
          $cont++;

          $margen = $row->total_venta > 0 ? (($row->total_costo/$row->total_venta) * 100) : 0;
          $fecha_pago = strlen($row->fecha_pago) == 0 ? '<span class = "text-danger">No Pagado</span>' : "<b>".fechaCortaAbreviada($row->fecha_pago)."</b>";

          $btn_edit = '';
          if($permisos->Editar){
                $btn_edit = strlen($row->fecha_pago) == 0 ? '<i class="fas fa-edit" onclick = "openModal('.$row->idcompra.', \''.$row->factura.'\', \''.$row->folio.'\',  \''.$row->serie.'\', '.$cont.');" title = "Editar"></i>' : '';
          }

          $output .= '<tr>
                          <td>'.$cont.'</td>
                          <td>'.fechaCortaAbreviada($row->fecha_corte).'</td>
                          <td>'.fechaCortaAbreviada($row->fecha_factura).'</td>
                          <td align = "right">'.$row->folio.'</td>
                          <td align = "right"><b>'.$row->serie.'</b></td>
                          <td align = "right"><b>'.$row->factura.'</b></td>
                          <td align = "right"><b>$'.number_format($row->total_costo,2).'</b></td>
                          <td align = "right"><b>$'.number_format($row->total_venta,2).'</b></td>
                          <td align = "right" id = "fp'.$cont.'">'.$fecha_pago.'</td>
                          <td align = "right">'.number_format($margen, 2).'%</td>
                          <td  align = "right" id = "bt'.$cont.'">'.$btn_edit.'</td>
                          <td  align = "right"><a class = "btn btn-sm my-btn-blue" target = "_blank" href = "../detail/'.$row->idcompra.'/"><i class="fas fa-info-circle" title = "Ver detalle"></i> Detalle</a></td>
                      </tr>';
        }

$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";


echo json_encode(["code" => 200, "output" => $output]);

?>

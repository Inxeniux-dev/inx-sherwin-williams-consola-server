<?php

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];


$data = $model->getIgualsByDate($page, $fechini, $fechfin);

$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output = '<table class = "table table-hover table-sm my-4">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Remisión</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th style = "text-align:right;">Cant</th>
                        <th style = "text-align:right;">Precio</th>
                        <th style = "text-align:right;">Desc %</th>
                        <th style = "text-align:right;">Importe</th>
                        <th style = "text-align:right;">Diferencia</th>
                    </tr>
                </thead>   <tbody>';


$COUNT_IGUALADOS = 0;
$TOTAL_IGUALADOS = 0;
$BASES_Y_TINTAS = 0;
$TOTAL_TINTAS = 0;

foreach ($data["iguals"] as $key => $value) {
  $COUNT_IGUALADOS++;
  $item_desc = calcula_importe_por_producto($value["precio"], $value["cantidad"], $value["descuento"]);

  $output .= '<tr class = "table-success">
                <td>'.fechaCortaConHora($value["fecha"]).'</td>
                <td>'.$value["serie"]."-".$value["folio"].'</td>
                <td>'.$value["codigo"].'</td>
                <td>'.$value["descripcion"].'</td>
                <td align = "right">'.number_format($value["cantidad"],0).'</td>
                <td align = "right">$'.number_format($value["precio"],2).'</td>
                <td align = "right">'.$value["descuento"].'%</td>
                <td align = "right">$'.number_format($item_desc["subtotal_neto"],2).'</td>
                <td align = "right"></td>
            </tr>';

            $TOTAL_IGUALADOS += $item_desc["subtotal_neto"];

            $total = 0;
            foreach ($value["desgloce"] as $keyi => $valuei) {
              $output .= '<tr>
                            <td colspan = "2"></td>
                            <td class = "table-info">'.$valuei["codigo"].'</td>
                            <td class = "table-info">'.$valuei["descripcion"].'</td>
                            <td class = "table-info" align = "right">'.$valuei["cantidad"].'</td>
                            <td class = "table-info" align = "right">$'.number_format($valuei["precio"],2).'</td>
                            <td class = "table-info" align = "right"></td>
                            <td class = "table-info" align = "right">$'.number_format($valuei["precio"] * $valuei["cantidad"],2).'</td>
                            <td></td>
                          </tr>';
                    $total += $valuei["precio"] * $valuei["cantidad"];

                    $TOTAL_TINTAS += $valuei["precio"] * $valuei["cantidad"];
                    
            }

              $output.= "<tr>
                            <td  colspan = '5'></td>
                            <td  class = 'table-info'></td>
                            <td  class = 'table-info' align = 'right'><b>TOTAL:</b></td>
                            <td  class = 'table-info' align = 'right'><b>$".number_format($total,2)."</b></td>
                            <td  class = 'table-info' align = 'right'><b>$".number_format($item_desc["subtotal_neto"] - $total,2)."</b></td>
                        </tr>";


    $output.= "<tr><td colspan = '9' style = 'height:20px;'></td></tr>";
}


$output.= "<tr>
              <td  colspan = '6'></td>
              <td  class = 'table-info' align = 'right'><b>NÚMERO DE IGUALADOS:</b></td>
              <td class = 'table-info' align = 'right'><b>".number_format($COUNT_IGUALADOS,0)."</b></td>
          </tr>";

$output.= "<tr>
              <td  colspan = '6'></td>
              <td  class = 'table-info' align = 'right'><b>TOTAL IGUALADOS:</b></td>
              <td class = 'table-info' align = 'right'><b>$".number_format($TOTAL_IGUALADOS,2)."</b></td>
          </tr>";

$output.= "<tr>
              <td  colspan = '6'></td>
              <td  class = 'table-info' align = 'right'><b>TOTAL (BASE Y TINTAS):</b></td>
              <td class = 'table-info' align = 'right'><b>$".number_format($TOTAL_TINTAS,2)."</b></td>
          </tr>";

$output.= "<tr>
              <td  colspan = '6'></td>
              <td  class = 'table-info' align = 'right'><b>DIFERENCIA:</b></td>
              <td class = 'table-info' align = 'right'><b>$".number_format($TOTAL_IGUALADOS - $TOTAL_TINTAS,2)."</b></td>
          </tr>";


  $output.="</tbody></table>";



  $output.="</tbody></table><div class='box-footer'>";
  $output .=$paginator;
  $output.="</div>";

echo json_encode(["code" => 200, "status" => true, "msg" => "", "error" => null, "data" => $output]);


?>

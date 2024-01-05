<?php


$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];
$client = isset($_GET["idclient"]) ? $_GET["idclient"] : 0;

if($client <= 0)
{
    $output = "<div class = 'alert alert-info'>Selecciona un cliente</div>";

    echo json_encode(["code" => 200, "status" => true, "msg" => "", "error" => null, "data" => $output]);
    return;
}


$data = $model->getOutBySaleWhitIguals($page, $fechini, $fechfin, $client);
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
                        <th style = "text-align:right;">Importe Art.</th>
                        <th style = "text-align:right;">Subtotal Venta</th>
                    </tr>
                </thead>   <tbody>';

foreach ($data["sales"] as $key => $value) {

    if($value["status"] != 1)
    {

    $output .= '<tr class = "table-warning">
                    <td>'.$value["fecha"].'</td>
                    <td>'.$value["serie"].'-'.$value["folio"].'</td>
                    <td colspan = "5"></td>
                    <td style = "text-align:right;">$'.number_format($value["total"],2).'</td>
                </tr>';

                foreach ($value["prods"] as $keyp => $valuep) {

                  $output .= '<tr>
                                  <td colspan = "2"></td>
                                  <td>'.$valuep["codigo"].'</td>
                                  <td>'.$valuep["descripcion"].'</td>
                                  <td align = "right">'.number_format($valuep["cantidad"],0).'</td>
                                  <td align = "right">$'.number_format($valuep["precio"],0).'</td>
                                  <td align = "right">$'.number_format(($valuep["cantidad"] * $valuep["precio"]), 2).'</td>
                                  <td align = "right"></td>
                              </tr>';


                        if($valuep["codigo"] == "IGUALCC" || $valuep["codigo"] == "IGUALMA")
                        {
                            foreach ($valuep["iguals"] as $keyi => $valuei) {

                              $output .= '<tr class = "table-info">
                                              <td colspan = "2"></td>
                                              <td>'.$valuei["codigo"].'</td>
                                              <td>'.$valuei["descripcion"].'</td>
                                              <td align = "right">$'.number_format($valuei["cantidad"],0).'</td>
                                              <td align = "right">$'.number_format($valuei["precio"],2).'</td>
                                              <td align = "right">$'.number_format(($valuei["cantidad"] * $valuei["precio"]), 2).'</td>
                                              <td align = "right"></td>
                                          </tr>';
                            }
                        }

                }


                  $output .= '<tr><td colspan = "8" style = "height:20px;"></td><tr>';
     }         

 }

  $output.="</tbody></table><div class='box-footer'>";
  $output .=$paginator;
  $output.="</div>";


echo json_encode(["code" => 200, "status" => true, "msg" => "", "error" => null, "data" => $output]);
?>

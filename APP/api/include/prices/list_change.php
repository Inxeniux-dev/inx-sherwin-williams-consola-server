<?php

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : date("Y-m.d");
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : date("Y-m.d");

$data = $cambioPrecioModel->findAll($page, $fechini, $fechfin);
$prices = $data["prices"];
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);



$output = '<table class = "table table-hover table-sm my-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th style = "text-align: right;">No Productos</th>
                        <th style = "text-align: right;">Responsable</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>';

            foreach ($prices as $key => $value) {
                $value = to_object($value);
                $output .= '<tr>
                                <td>'.$value->id.'</td>
                                <td>'.fechaCortaConHora($value->created_at).'</td>
                                <td align = "right">'.number_format($value->no_prod, 0).'</td>
                                <td align = "right">'.$value->nombre.'</td>
                                <td align = "center">
                                        <a href = "../detail/'.$value->id.'/" class = "btn btn-info btn-sm">Detalle</a>
                                </td>
                           </tr>';
            }


$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";


echo json_encode(["code" => 200, "data" => $output]);

?>

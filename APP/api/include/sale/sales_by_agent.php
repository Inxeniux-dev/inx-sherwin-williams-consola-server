<?php

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];
$id_agente = isset($_GET["iduser"]) ? $_GET["iduser"] : 1;


$data = $model->salesByAgent($page, $fechini, $fechfin, $id_agente);
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output  = '<table  class="table table-hover table-condensed table-sm">
            <thead>
                <tr>
                  <th>Remisión</th>
                  <th>fecha</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Línea</th>
                  <th style = "text-align:right;">Cantidad</th>
                  <th style = "text-align:right;">Precio</th>
                  <th style = "text-align:right;">Importe</th>
                </tr>
            </thead>
            <tbody>';
      $total = 0;
      $count = 0;
      while($row = $data["sales"]->fetch_object())
      {

          $output .= "<tr>
                            <td>".$row->serie."-".$row->folio."</td>
                            <td>".fechaCortaAbreviadaConHora($row->fecha)."</td>
                            <td>".$row->codigo."</td>
                            <td>".$row->descripcion."</td>
                            <td>".$row->idlinea."-".$row->descripcion_linea."</td>
                            <td align = 'right'>".number_format($row->cantidad, 0)."</td>
                            <td align = 'right'>".number_format($row->precio, 0)."</td>
                            <td align = 'right'>$".number_format(($row->cantidad * $row->precio), 2)."</td>
                      </tr>";

                $total = ($row->cantidad * $row->precio);
                $count += $row->cantidad;
      }


    $output.="</tbody></table><div class='box-footer'>";
    $output .=$paginator;
    $output.="</div>";


  if( $data["sales"]->num_rows == 0) { $output = '<div class = "alert alert-info">No existen registros</div>'; }

  echo json_encode(["code" => 200, "data" => $output]);

?>

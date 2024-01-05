<?php

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];
$id_cliente = isset($_GET["idcliente"]) ? $_GET["idcliente"] : 0;


$data = $model->ventas_acumuladas_por_cliente($page, $fechini, $fechfin, $id_cliente);

$output  = '<table  class="table table-hover table-condensed table-sm">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th style = "text-align:right;">Remisiones</th>
                  <th style = "text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>';
      $total = 0;

      while($row = $data->fetch_object())
      {
          $nombre = $row->tipo == 0 ? $row->razon_social : $row->nombre." ".$row->apellido;

          $output .= "<tr>
                            <td>".$row->idcliente."</td>
                            <td>".$nombre."<br><b>".$row->rfc."</b></td>
                            <td align = 'right'>".number_format($row->comandas, 0)."</td>
                            <td align = 'right'>$".number_format($row->total, 2)."</td>
                      </tr>";

            $total += $row->total;
      }


      $output .= "<tr>
                        <td colspan = '2'></td>
                        <td align = 'right'><b>TOTAL</b></td>
                        <td align = 'right'><b>$".number_format($total, 2)."</b></td>
                  </tr>";

   $output.="</tbody></table>";


  if( $data->num_rows == 0) { $output = '<div class = "alert alert-info">No existen registros</div>'; }

  echo json_encode(["code" => 200, "data" => $output]);

?>

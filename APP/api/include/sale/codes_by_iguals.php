<?php

  $identified = isset($_GET["identified"]) ? $_GET["identified"] : 0;
  $data = $model->getProductListByIDWhitIguals($identified);

  $output = "<table class='table table-hover table-condensed table-sm'>
                      <thead>
                          <tr>
                              <th>Código</th>
                              <th>Descripción</th>
                              <th>Cantidad</th>
                              <th style = 'text-align:right;'>Precio</th>
                              <th style = 'text-align:right;'>Descuento</th>
                              <th style = 'text-align:right;'>Importe</th>
                          </tr>
                      </thead>
                      <tbody>
                  <tbody>";

                    for($x =0; $x<count($data); $x++)
                    {
                      $output .= "<tr>
                                      <td><b>".$data[$x]["codigo"]."</b></td>
                                      <td><b>".$data[$x]["descripcion"]."</b></td>
                                      <td align = 'right'>".$data[$x]["cantidad"]."</td>
                                      <td align = 'right'>$ ".number_format($data[$x]["precio"],2)."</td>
                                      <td align = 'right'>".$data[$x]["descuento"]."</td>
                                      <td align = 'right'>$ </td>
                                <tr>";

                              for($y = 0; $y<count($data[$x]["codes_igual"]); $y++)
                              {
                                $codes = $data[$x]["codes_igual"][$y];

                                $output .= "<tr class = 'table-primary'>
                                                <td>".$codes["codigo"]."</td>
                                                <td>".$codes["descripcion"]."</td>
                                                <td align = 'right'>".$codes["cantidad"]."</td>
                                                <td align = 'right'>$ ".number_format($codes["precio"],2)."</td>
                                                <td align = 'right'></td>
                                                <td align = 'right'>$ ".number_format(($codes["cantidad"] * $codes["precio"]),2)."</td>
                                          <tr>";
                              }
                    }

    $output .= "<tr>
                    <td colspan = '4' align = 'right'><b>TOTAL</b></td>
                    <td align = 'right'><b>$</b></td>
                    <td align = 'center'></td>
                </tr>";
  echo $output;

?>

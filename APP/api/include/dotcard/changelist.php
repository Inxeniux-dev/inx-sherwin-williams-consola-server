<?php

$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

$data = $model->getListChangesWhidProds($page, $fechini, $fechfin);
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$changes = $data["changes"];

    $output = "<table class='table table-hover table-condensed table-sm'>
                        <thead>
                            <tr>
                                <th>Tarjeta</th>
                                <th>Fecha</th>
                                <th style = 'text-align:right;'>Remisión</th>
                                <th style = 'text-align:right;'>Puntos</th>
                                <th style = 'text-align:right;'>Productos</th>
                                <th style = 'text-align:right;'>Importe</th>
                                <th style = 'text-align:center;'><i class='fa fa-search'></th>
                            </tr>
                        </thead>
                        <tbody>
                    <tbody>";

                        for($x=0; $x <count($changes); $x++)
                        {
                          $row = $changes[$x];
                          $productos = '';

                          for($y=0; $y<count($row["prods"]); $y++)
                          {
                              $prod = $row["prods"][$y];
                              $productos .= $prod["producto"].",  $".number_format($prod["precio"],2)." <br> ";
                          }

                          $output .="<tr>
                                        <td><b>".$row["num_tarjeta"]."</b> <br> ".$row["nombre"]."</td>
                                        <td>".$row["fecha"]."</td>
                                        <td align = 'right'>".$row["remision"]."</td>
                                        <td align = 'right'>".number_format($row["puntos"],0)."</td>
                                        <td align = 'right'>".$productos."</td>
                                        <td align = 'right'>$ ".number_format($row["importe"],2)."</td>
                                        <td align = 'right'>
                                                  <div class='dropdown'>
                                                      <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                          <i class='fa fa-ellipsis-h'></i>
                                                      </button>
                                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                            <a class='dropdown-item text-default' href='../changedetail/".$row["id"]."/'>
                                                                <i class='fas fa-search'></i> Ver Detalles
                                                            </a>
                                                        </div>
                                                  </div>
                                        </td>
                                  </tr>";
                        }

        $output .= "<tbody>
                </table> <div class='box-footer'>";

       $output.= $paginator."</div>";
      echo $output;
?>

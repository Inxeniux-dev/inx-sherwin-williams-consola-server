<?php

$search = isset($_POST["search"]) ? trim($_POST["search"]) : "";
$capacity = isset($_POST["capacity"]) ? $_POST["capacity"] : 0;
$line = isset($_POST["line"]) ? $_POST["line"] : 0;
$page = isset($_POST["page"]) ? $_POST["page"] : 1;

$data = $model->list($page, $line, $capacity, $search);
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output = '<table class = "table table-sm">
              <thead>
                  <th>Código</th>
                  <th>Base</th>
                  <th style = "text-align:right">Precio</th>
                  <th style = "text-align:right">Precio Especial</th>
                  <th style = "text-align:right">%</th>
                  <th style = "text-align:right">Linea</th>
                  <th style = "text-align:right">Clave SAT  </th>
                  <th style = "text-align:right">Peso</th>
                  <th style = "text-align:right">Marca</th>
                  <th style = "text-align:right"><small><b>Últ Actualización</b></small></th>
                  <th></th>
              </thead>
              <tbody>';


        $cont = 0;

        while($row = $data["items"]->fetch_object())
        {
            $update = substr($row->update_at, 0, 10);
            if(date("Y-m-d") == $update)
            {
              $update_at = "<b>".fechaCortaAbreviadaConHora($row->update_at)."<br>";
            }
            else {
              $update_at = fechaCortaAbreviadaConHora($row->update_at);
            }

            $es_base = $row->es_base == 1 ? '<b><i class="fas fa-check-circle"></i></b>' : "No";

            $cont++;

            $warning_class = '';
            if(strlen($row->clave_sat) < 8 || strlen($row->peso) == 0 || $row->peso == 0)
            {
                $warning_class = 'class = "table table-warning"';
            }

            $output .= '<tr '.$warning_class.'>
                          <td><b>'.$row->codigo.'</b> <br> '.$row->descripcion.'</td>
                          <td align = "center">'.$es_base.'</td>
                          <td align = "right">$'.number_format($row->precio, 2).'</td>
                          <td align = "right">$'.number_format($row->precio_especial, 2).'</td>
                          <td align = "right">'.number_format($row->descuento, 2).'%
                            <br>
                            <small  class = "text-primary" title = "Descuento de reforzamiento">
                              <b>
                                '.$row->descuento_ref.'%
                              </b>
                            </small>
                          </td>
                          <td align = "right">'.$row->idlinea."-".$row->linea.'</td>
                          <td align = "right">'.$row->clave_sat.'</td>
                          <td align = "right">'.$row->peso.'</td>
                          <td align = "right">'.$row->marca.'</td>
                          <td align = "right" id = "update-r'.$cont.'">'.fechaCortaAbreviadaConHora($row->update_at).'</td>
                          <td align = "center">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <h6 class="dropdown-header"><b>Opciones</b></h6>
                                  <a class="dropdown-item" href="../detail/'.$row->id.'/" ><i class="fas fa-eye"></i> Ver detalle</a>';
                                  if($permisos->Editar)
                                  {
                                      $output .= '<div class="dropdown-divider"></div>';
                                      $output .= '<a class="dropdown-item" href="../edit/'.$row->id.'/" ><i class="fas fa-edit"></i> Editar</a>';
                                  }
                                  if($permisos->Eliminar)
                                  {
                                      $output .= '<div class="dropdown-divider"></div>';
                                      $output .= '<a class="dropdown-item" href="../delete/'.$row->id.'/" ><i class="fas fa-trash"></i> Eliminar</a>';
                                  }
                      $output .= '</div>
                            </div>
                          </td>
                        </tr>';
        }

$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";



echo json_encode(["code" => 200, "output" => $output]);

?>

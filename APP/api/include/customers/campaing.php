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
                  <th style = "text-align:right">Precio</th>
                  <th style = "text-align:right">Descuento Actual</th>
                  <th style = "text-align:right">Descuento</th>
                  <th style = "text-align:right">Fecha Inicial</th>
                  <th style = "text-align:right">Fecha Final</th>
                  <th style = "text-align:right">Linea</th>
                  <th style = "text-align:center">Suc Ref</th>
                  <th style = "text-align:right"><small><b>Últ Actualización</b></small></th>
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

            $cont++;

            $output .= '<tr>
                          <td><b>'.$row->codigo.'</b> <br> '.substr($row->descripcion, 0, 40).'</td>
                          <td align = "right">$'.number_format($row->precio, 2).'</td>
                          <td align = "right"  id = "discount-r'.$cont.'" data-p'.$cont.' = "'.number_format($row->descuento, 2).'">'.number_format($row->descuento, 2).'%</td>
                          <td align = "right">
                              <input type = "text" class = "form-control form-control-sm i-discount" placeholder = "Ingrese descuento" style = "width:80px; text-align:right"
                              value = "'.$row->descuento.'"
                              data-c = "'.$cont.'"
                              data-code = "'.$row->codigo.'"
                              data-id = "'.$row->id.'"
                              id = "discount'.$cont.'"
                              />
                              <small  class = "text-primary">
                                <b>
                                  Ref: '.$row->descuento_ref.'%
                                </b>
                              </small>
                          </td>
                          <td align = "right">
                              <input type = "date" class = "form-control form-control-sm i-fechini" placeholder = "Ingrese descuento" style = "width:160px; text-align:right"
                              value = "'.$row->fechini.'"
                              id = "fechini'.$cont.'"
                              data-c = "'.$cont.'"
                              data-code = "'.$row->codigo.'"
                              data-id = "'.$row->id.'"
                              >
                              <small class = "text-primary">
                              <b>
                                Ref: '.fechaCortaAbreviada($row->fechini_ref).'
                              </b>
                            </small>
                          </td>
                          <td align = "right">
                              <input type = "date" class = "form-control form-control-sm i-fechfin" placeholder = "Ingrese descuento" style = "width:160px; text-align:right"
                              value = "'.$row->fechfin.'"
                              id = "fechfin'.$cont.'"
                              data-c = "'.$cont.'"
                              data-code = "'.$row->codigo.'"
                              data-id = "'.$row->id.'"
                              >
                              <small  class = "text-primary">
                              <b>
                                Ref: '.fechaCortaAbreviada($row->fechfin_ref).'
                              </b>
                            </small>
                          </td>
                          <td align = "right">'.$row->idlinea."-".$row->linea.'</td>
                          <td align = "center" class = "text-primary">'.$row->sucursales.'</td>
                          <td align = "right" id = "update-r'.$cont.'">'.fechaCortaAbreviadaConHora($row->update_at).'</td>
                        </tr>';
        }

$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";



echo json_encode(["code" => 200, "output" => $output]);

?>

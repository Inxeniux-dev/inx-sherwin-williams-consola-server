<?php

$search = isset($_POST["search"]) ? trim($_POST["search"]) : "";
$tipo = isset($_POST["type"]) ? $_POST["type"] : 0;
$page = isset($_POST["page"]) ? $_POST["page"] : 1;

$data = $model->list_change($page, $tipo, $search);
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output = '<table class = "table table-sm">
              <thead>
                  <th>Producto</th>
                  <th style = "text-align:right">Cantidad</th>
                  <th style = "text-align:right">Precio</th>
                  <th></th>
              </thead>
              <tbody>';

        while($row = $data["items"]->fetch_object())
        {
            $output .= '<tr>
                          <td><b>'.$row->producto.'</b></td>
                          <td align = "right">'.number_format($row->cantidad, 0).'</td>
                          <td align = "right">$'.number_format($row->precio, 2).'</td>
                          <td align = "center">';

                    if($permisosCanje->Editar || $permisosCanje->Eliminar){

                          $output .= '<div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                        if($permisosCanje->Editar){
                                          $output .= '<h6 class="dropdown-header"><b>Opciones</b></h6>
                                          <a class="dropdown-item" href="../edit/'.$row->idproducto.'/" ><i class="fas fa-pen"></i> Editar</a>';
                                        }
                                        if($permisosCanje->Eliminar){
                                          $output .= '<div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)"; onclick = "check_delete('.$row->idproducto.')" ><i class="fas fa-trash"></i> Eliminar</a>
                                          </div>';
                                        }

                          $output .= '</div>';
                    }


                  $output .= '</td>
                      </tr>';
        }

$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";



echo json_encode(["code" => 200, "output" => $output]);

?>

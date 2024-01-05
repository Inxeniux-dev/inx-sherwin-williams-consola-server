<?php

$fechini = isset($_POST["fechini"]) ? $_POST["fechini"] : date("Y-m-d");
$fechfin = isset($_POST["fechfin"]) ? $_POST["fechfin"] : date("Y-m-d");
$status = isset($_POST["estatus"]) ? $_POST["estatus"] : 1;
$proyecto = isset($_POST["proyecto"]) ? $_POST["proyecto"] : 0;

$data = $model->getList($fechini, $fechfin, $status, $proyecto);
$output = '<table class = "table table-sm">
              <thead>
                  <th>Versión</th>
                  <th>Estado</th>
                  <th>Proyecto</th>
                  <th></th>
              </thead>
              <tbody>';

        while($row = $data->fetch_object())
        {
          $estado = "";
          if($row->status == 0){ $estado = "Producción"; }
          if($row->status == 1){ $estado = "Desarrollo"; }
          if($row->status == 2){ $estado = "Pruebas"; }

          $icon = "";
          $link = 'edit';
          $link_text = 'Editar';
          $link_icon = '<i class="fas fa-edit"></i> ';

          if($row->status == 0){ $icon = '<i class="fas fa-rocket"></i> '; $link = 'detail'; $link_text = 'Ver detalles'; $link_icon = '<i class="fa fa-search"></i> '; }
          if($row->status == 1){ $icon = '<i class="fas fa-laptop-code"></i> '; }
          if($row->status == 2){ $icon = '<i class="fas fa-vial"></i> '; }

            $output .= '<tr>
                          <td><b>'.$row->version.'</b><br> '.$row->create_at.'</td>
                          <td>'.$icon.$estado.'</td>
                          <td>'.$row->nombre.'</td>
                          <td align = "center">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <h6 class="dropdown-header"><b>Opciones</b></h6>
                                  <a class="dropdown-item" href="../'.$link.'/'.$row->id.'/" >'.$link_icon.' '.$link_text.'</a>
                                </div>
                            </div>
                          </td>
                        </tr>';
        }

  $output .= '</tbody>
          </table>';


echo json_encode(["code" => 200, "output" => $output]);

?>

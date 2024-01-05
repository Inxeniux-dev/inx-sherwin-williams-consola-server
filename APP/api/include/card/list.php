<?php

  $search = isset($_POST["search"]) ? $_POST["search"] : '';
  $status = isset($_POST["status"]) ? $_POST["status"] : '';

  $model->search = $search;
  $model->status = $status;
  $cards = $model->getList();
  $paginator =  '';


  $output = '<table class = "table table-sm table-condensed table-hover">
                <thead>
                    <th>Tarjeta</th>
                    <th style = "text-align:right">Puntos</th>
                    <th style = "text-align:right">Descuento</th>
                    <th style = "text-align:right">Teléfono</th>
                    <th style = "text-align:right">Email</th>
                    <th style = "text-align:center">Status</th>
                    <th style = "text-align:right"><small><b>Últ Actualización</b></small></th>
                    <th></th>
                </thead>
                <tbody>';

                while($row = $cards->fetch_object())
                {
                    $css_class =  "";
                    if($row->idtarjeta == 1){
                      $css_class = 'class = "table-info"';
                    }

                    $status_icon = '<i class="fa fa-minus-circle" aria-hidden="true"></i> Desactivar';
                    $status = "<span class = 'text-success'><b>Activo</b></span>";
                    if($row->status == 0){
                      $status_icon = '<i class="fa fa-check-circle" aria-hidden="true"></i>  Activar';
                      $status = "<span class = 'text-danger'><b>Inactivo<b></span>";
                    }

                    $output .= '<tr '.$css_class.'>
                                    <td><b>'.$row->no_tarjeta.'</b><br>'.$row->nombre.' '.$row->apellido.'</td>
                                    <td align = "right">'.number_format($row->puntos, 0).'</td>
                                    <td align = "right">'.number_format($row->descuento, 2).'%</td>
                                    <td  align = "right">'.phoneformat($row->telefono).'</td>
                                    <td  align = "right">'.$row->email.'</td>
                                    <td  align = "right">'.$status.'</td>
                                    <td  align = "right"><i class="far fa-clock"></i> '.$row->update_at.'</td>
                                    <td  align = "center">';

                                    if($row->idtarjeta > 1){
                                          $output .= '<div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                          <h6 class="dropdown-header"><b>Opciones</b></h6>
                                                          <a class="dropdown-item" href="../history/'.$row->idtarjeta.'/" ><i class="far fa-clock"></i> Historial</a>';
                                                          if($permisos->Editar)
                                                          {
                                                              $output .= '<div class="dropdown-divider"></div>
                                                                      <a onclick = "change_status('.$row->idtarjeta.', '.$row->status.')" class="dropdown-item" href="javascript:void(0);" >'.$status_icon.'</a>';
                                                          }
                                            $output .= '</div>
                                                   </div>';
                                      }
                                $output .= '</td>
                                <tr>';
                }

$output.="</tbody></table><div class='box-footer'>";
$output.= $paginator;
$output.="</div>";


  echo json_encode(["code" => 200, "output" => $output])
?>

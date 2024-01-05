<?php

$id_empleado = isset($_GET["idemploye"]) ? $_GET["idemploye"] : 0;
$modelRotacion->id_empleado = $id_empleado;
$rotacion = $modelRotacion->getList();

$output = '<table class = "table table-condensed table-hover">
              <thead>
                  <th>sucursal Asignada</th>
                  <th>Fecha Creación</th>
                  <th>Expiración</th>
                  <th></th>
                  <th></th>
              </thead>
              <tbody>';

              while($row = $rotacion->fetch_object())
              {
                  $status = date("Y-m-d") > $row->expiracion ? '<span class = "text-danger">Expirado</span>' : '<span class = "text-success">Vigente</span>';
                  $nombre = $row->idsucursal == 0 ? 'MATRIZ' : $row->nombre;
                   $output .= '<tr>
                                <td><b>'.strtoupper($row->idsucursal."-".$nombre).'</b></td>
                                <td>'.fechaCortaAbreviadaConHora($row->create_at).'</td>
                                <td>'.fechaCortaAbreviada($row->expiracion).'</td>
                                <td>'.$status.'</td>
                                <td align = "center">
                                  <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <h6 class="dropdown-header"><b>Opciones</b></h6>
                                          <a class="dropdown-item" href="javascript:void(0);" onclick = "expirar('.$row->idrotacion.');"><i class="fa fa-trash"></i> Expirar Asignación</a>
                                       </div>
                                  </div>
                                </td>
                            </tr>';

              }

$output.="</tbody>";
echo json_encode(["code" => 200, "output" => $output]);
?>

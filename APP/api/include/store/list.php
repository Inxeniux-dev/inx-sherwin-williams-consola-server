<?php

$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "";
$estado = isset($_GET["estado"]) ? $_GET["estado"] : "";

$model->almacen = $tipo;
$model->status = $estado;
$data = $model->getList();

$output = '<table class = "table table-sm">
              <thead>
                  <th>Nombre</th>
                  <th>Serie</th>
                  <th>IP Remota</th>
                  <th>Tipo</th>
                  <th>Calle</th>
                  <th>Cruzamiento</th>
                  <th>Colonia</th>
                  <th>Teléfono</th>
                  <th></th>
              </thead>
              <tbody>';

        while($row = $data->fetch_object())
        {
              $tipo = '<i class="fas fa-store"></i> Tienda';
              if($row->almacen == 1){
                  $tipo = '<b><i class="fas fa-boxes"></i> Almacén</b>';
              }
              if($row->almacen == 3){ $tipo = '<b><i class="fas fa-user-check"></i> Auditoría</b>'; }

              $output .= '<tr>
                            <td><b>'.addCeros($row->idsucursal).'</b><br> '.$row->nombre.'</td>
                            <td align ="center">'.$row->serie.'</td>
                            <td>'.$row->ip.'</td>
                            <td>'.$tipo.'</td>
                            <td>'.$row->direccion.'</td>
                            <td>'.$row->cruzamiento.'</td>
                            <td>'.$row->colonia.'</td>
                            <td>'.$row->telefono.'</td>
                            <td align = "center">
                              <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <h6 class="dropdown-header"><b>Opciones</b></h6>
                                      <a class="dropdown-item" href="../detail/'.$row->idsucursal.'/" ><i class="fa fa-search"></i> Ver Detalles</a>
                                      <div class="dropdown-divider"></div>';

                              if($permisos->Editar)
                              {
                                $output .= '<a class="dropdown-item" href="../edit/'.$row->idsucursal.'/" ><i class="fa fa-edit"></i> Editar</a>';
                              }

                              if($row->version == 0)
                              {
                                  $output .= '<div class="dropdown-divider"></div>';
                                  $output .= '<a class="dropdown-item" href="../updateSetting/'.$row->idsucursal.'/" ><i class="fas fa-wrench"></i> Editar Configuración</a>';
                              }

                              if($row->version == 1)
                              {
                                  if($permisos->Query_Remota)
                                  {
                                      $output .= '<div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="../queryService/'.$row->idsucursal.'/" ><i class="fas fa-database"></i> Queries Service</a>';
                                  }
                              }

                      $output .= '</div>
                              </div>
                            </td>
                          </tr>';
        }

  $output .= '</tbody>
          </table>';


echo json_encode(["code" => 200, "output" => $output]);

?>

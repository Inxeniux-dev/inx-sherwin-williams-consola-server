<?php


    $res = $model->all_users();


    $output = '<table class = "table table-hover table-sm my-4">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>';

    while($row = $res->fetch_object())
    {
          $tipo = '';

          if($row->tipo == 1) { $tipo = 'Administrador'; }
          if($row->tipo == 2) { $tipo = 'Vendedor'; }
          if($row->tipo == 3) { $tipo = 'Ayudante Ventas'; }
          if($row->tipo == 4) { $tipo = 'Contabilidad'; }
          if($row->tipo == 5) { $tipo = 'Sistemas'; }

          $output .= '<tr>
                        <td>'.$row->nombre.'</td>
                        <td>'.$tipo.'</td>';
                        $output .= "<td align = 'center'>";

                        if($row->iduser > 1)
                        {

                                $output .= " <div class = 'dropdown'>
                                                  <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                      <i class='fa fa-ellipsis-h'></i>
                                                  </button>
                                                    <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuButton'>
                                                            <h6 class='dropdown-header'><b>Permisos</b></h6>
                                                            <a href='../user_edit/".$row->iduser."/' class = 'dropdown-item'><i class='fas fa-user-circle'></i> Editar Permisos</a>
                                                            <h6 class='dropdown-header'><b>Acciones</b></h6>
                                                            <a href='javascript:void(0);' class = 'dropdown-item' onclick = 'delete_user($row->iduser);';><i class='fas fa-trash-alt'></i> Eliminar</a>
                                                     </div>
                                            </div>";
                        }

                $output .= "</td></tr>";

    }

    $output .= "</tbody>";

    echo json_encode(["code" => 200, "status" => true,  "msg" => "", "error" => null, "data" => $output]);

?>

<?php

$page = isset($_POST["page"]) ? $_POST["page"] : 1;
$type = isset($_POST["type"]) ? $_POST["type"] : 0;
$search = isset($_POST["search"]) ? trim($_POST["search"]) : "";
$apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";

$data = $model->list($page, $type, $search, $apellido);
$paginator = $appService->getPaginatorAjax($data["paginator"], $page);

$output = '<table class = "table table-sm table-hover">
              <thead>
                  <th>#</th>
                  <th>Cliente</th>
                  <th style = "text-align:center">Email</th>
                  <th style = "text-align:center">Teléfono</th>
                  <th style = "text-align:center"><i class="fa fa-search"></th>
                  <th></th>
              </thead>
              <tbody>';


        $cont = 0;

        while($row = $data["items"]->fetch_object())
        {
            $nombre = $row->NOMBRE." ".$row->APELLIDO;
            if($row->TIPO == 0){ $nombre = $row->RAZON_SOCIAL; }

            $nombre = $appService->sanear_string($nombre, true);

            $cont++;

            $warning_class = '';

            $output .= '<tr '.$warning_class.'>
                          <td align = "center">'.$row->IDCLIENTE.'</td>
                          <td><b>'.$row->RFC.' </b> <br> '.$nombre.'</td>
                          <td align = "center">'.$row->EMAIL.'</td>
                          <td align = "center">'.$row->TELEFONO.'</td>
                          <td align = "right">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <h6 class="dropdown-header"><b>Opciones</b></h6>
                                  <a class="dropdown-item" href="../detail/'.$row->IDCLIENTE.'/" ><i class="fas fa-eye"></i> Ver detalle</a>';
                                  if($permisos->Editar)
                                  {
                                      $output .= '<div class="dropdown-divider"></div>';
                                      $output .= '<a class="dropdown-item" href="../edit/'.$row->IDCLIENTE.'/" ><i class="fas fa-edit"></i> Editar</a>';
                                  }
                                  if($permisos->Eliminar)
                                  {
                                      $output .= '<div class="dropdown-divider"></div>';
                                      $output .= '<a class="dropdown-item" href="../delete/'.$row->IDCLIENTE.'/" ><i class="fas fa-trash"></i> Eliminar</a>';
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

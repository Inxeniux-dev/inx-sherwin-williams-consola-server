<?php
$sucursal = isset($_GET["sucursal"]) ? $_GET["sucursal"] : -1;
$orden = isset($_GET["orden"]) ? $_GET["orden"] : 3;
$search = isset($_GET["search"]) ? $_GET["search"] : '';

$order = 'nombre';
switch ($orden) {
case 2:
  $order = 'apellido';
break;
case 3:
  $order = 'no_empleado';
break;
}

$model->filter_idsucursal = $sucursal == -1 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
$model->orden = $order;
$model->search = $search;
$empleados = $model->getList();

$output = '<table class = "table table-sm table-condensed table-hover">
              <thead>
                  <th>Número</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Sucursal Base</th>
                  <th></th>
              </thead>
              <tbody>';

              while($row = $empleados->fetch_object())
              {
                if($row->idempleado > 1)
                {

                  $sucursal = $row->idsucursal == 0 ? '<b>00-MATRIZ</b>' : addCeros($row->idsucursal).'-'.$row->nombre_sucursal;
                  $css_class = $row->no_empleado == 0 ? 'class = "table-warning" ' : '';

                   $output .= '<tr '.$css_class.'>
                                <td><b>'.$row->no_empleado.'</b></td>
                                <td>'.$row->nombre.'</td>
                                <td>'.$row->apellido.'</td>
                                <td>'.$sucursal.'</td>
                                <td align = "center">
                                  <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <h6 class="dropdown-header"><b>Opciones</b></h6>
                                          <a class="dropdown-item" href="../detail/'.$row->idempleado.'/" ><i class="fa fa-search"></i> Ver Datos</a>';
                                      if($permisos->Empleados->Editar){
                                          $output .= '<div class="dropdown-divider"></div> <a class="dropdown-item" href="../edit/'.$row->idempleado.'/" ><i class="fa fa-edit"></i> Editar</a>';
                                      }
                                      if($permisos->Empleados->Eliminar){
                                          $output .= '<div class="dropdown-divider"></div> <a class="dropdown-item" href="../delete/'.$row->idempleado.'/" ><i class="fa fa-trash"></i> Eliminar</a>';
                                      }
                                      if($permisos->Empleados->Editar){
                                          $output .= '<div class="dropdown-divider"></div> <a class="dropdown-item" href="../rotacion/'.$row->idempleado.'/" ><i class="fa fa-store"></i> Asignar a Sucursal</a>';
                                      }


                            $output .= '</div>
                                  </div>
                                </td>
                            </tr>';
                }
              }

$output.="</tbody>";
echo json_encode(["code" => 200, "output" => $output]);
?>

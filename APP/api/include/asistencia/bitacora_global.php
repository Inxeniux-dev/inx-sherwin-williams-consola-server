<?php
$sucursal = isset($_GET["sucursal"]) ? $_GET["sucursal"] : 0;
$mes = isset($_GET["mes"]) ? $_GET["mes"] : date("m");
$anio = isset($_GET["anio"]) ? $_GET["anio"] : date("y");
$orden = isset($_GET["orden"]) ? $_GET["orden"] : 3;

$order = 'empleado.no_empleado';
switch ($orden) {
  case 2:
    $order = 'empleado.nombre';
  break;
  case 3:
    $order = 'empleado.apellido';
  case 4:
    $order = 'empleado.idsucursal, empleado.no_empleado ASC';
  break;
}

$model->orden = $order;
$model->filter_idsucursal = $sucursal == -1 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
$empleados = $model->getList();

$fecha_actual = $anio."-".$mes."-21";
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha_actual ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$data_fecha_ant = explode("-", $nuevafecha);
$fecha_anterior = $data_fecha_ant[0]."-".$data_fecha_ant[1]."-20";

$modelBicatora->create_at = $fecha_anterior;
$modelBicatora->create_at_final = $fecha_actual;
$modelBicatora->idconcepto = 3;
$modelBicatora->filter_idsucursal = $sucursal == -1 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
$modelBicatora->orden = $order;

$data_empleados = array();
while($row = $empleados->fetch_object())
{
    $modelBicatora->idempleado = $row->idempleado;
    $bitacora = $modelBicatora->getListByIdEmpleado();

    $data_empleados[] = [
      "id" => $row->idempleado,
      "nombre" => $row->nombre,
      "apellido" => $row->apellido,
      "no_empleado" => $row->no_empleado,
      "tipo" => $row->tipo,
      "bitacora" => $bitacora   //MysqlObjectResult
    ];
}

$encabezados = $service->generaEncabezados($mes, $anio);
$data_procesada = $service->formatEmpleadosAsistencia($data_empleados, $encabezados);

$output = '<table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th></th>
                <th>Nombre</th>';
                foreach ($encabezados as $key => $value) {
                    $value = to_object($value);
                    $output .= "<th><small>".$value->nombre."</small>".$value->numero."</th>";
                }
$output .= "<th>Re</th>
            <th>Min</th>
            <th>Va</th>
            </tr>
          </thead>
          <tbody>";

          foreach ($data_procesada as $key => $value) {
                $value = to_object($value);
                $output .= "<tr>
                                <td align = 'center'><b>".$value->no_empleado."</b></td>
                                <td align = 'center'><b><i class = 'fas fa-edit'></i></b></td>
                                <td align = 'right'><b>".$value->nombre."</b></td>";

                                foreach ($value->dias as $k => $val) {
                                    $val = to_object($val);
                                    $asistencia = $val->asistencia;
                                    $css_class = '';
                                    switch ($asistencia->code) {
                                      case 2:   $css_class = 'table-danger';  break;
                                      case 3:   $css_class = 'table-warning';  break;
                                    }


                                    $output .= "<td  align = 'center' class = '".$css_class."'><b>".$asistencia->hora."</b></td>";
                                }


                $output .= "</tr>";
          }


$output .= "</tbody></table>";
echo $output;
?>

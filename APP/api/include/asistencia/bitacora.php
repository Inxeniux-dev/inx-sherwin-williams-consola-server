<?php

  $sucursal = isset($_GET["sucursal"]) ? $_GET["sucursal"] : 0;
  $fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : date("y-m-d");
  $movimiento = isset($_GET["movimiento"]) ? $_GET["movimiento"] : 3;
  $orden = isset($_GET["orden"]) ? $_GET["orden"] : 3;


$order = 'date_store DESC';
switch ($orden) {
  case 2:
    $order = 'empleado.nombre';
  break;
  case 3:
    $order = 'empleado.idsucursal';
  break;
  case 4:
    $order = 'date_store';
  break;
}


  $modelBicatora->create_at = $fecha;
  $modelBicatora->create_at_final = $fecha;
  $modelBicatora->idconcepto = $movimiento == 0 ? "" : $movimiento;
  $modelBicatora->filter_idsucursal = $sucursal == 0 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
  $modelBicatora->orden = $order;
  $bitacora = $modelBicatora->getList();

  $output = '<table class = "table table-sm table-condensed table-hover">
                <thead>
                    <th>Nombre</th>
                    <th>Suc Base</th>
                    <th>Suc Reporte</th>
                    <th></th>
                    <th style ="text-align:right">Fecha</th>
                    <th style ="text-align:right">Hora</th>
                    <th style ="text-align:right">Observación</th>
                </thead>
                <tbody>';

        while($row = $bitacora->fetch_object())
        {
            $concepto = $row->idconcepto == 3 ? '<span class = "text-success"><b>Entrada</b></span>' : '<span class = "text-danger">Salida</span>';
            $minutos = diferencia_en_fechas(substr($row->date_store, 0, 10)." 08:00:00", $row->date_store);
            $observacion = $minutos >= 6 ? "<span>Retardo de ".convertirMinutosAHoras($minutos)."</span>" : '';
            $observacion = $row->idconcepto == 3 ? $observacion : '';

            $observacion .= $row->suc_base != $row->idsucursal ? "<br> La sucursal de reporte es diferente a la base ": "";
            $sucursal_base = $row->suc_base == 0 ? 'Matriz' : $row->nombre_base;

            $output .= '<tr>
                            <td><b>'.strtoupper($row->nombre.' '.$row->apellido).'</b></td>
                            <td>'.strtoupper($sucursal_base).'</td>
                            <td>'.strtoupper($row->nombre_sucursal).'</td>
                            <td>'.$concepto.'</td>
                            <td align = "right">'.fechaCortaAbreviada($row->date_store).'</td>
                            <td align = "right">'.substr($row->date_store, 11).'</td>
                            <td align = "right"><b>'.$observacion.'</b></td>
                        <tr>';
        }


  $output.="</tbody>";

  echo json_encode(["code" => 200, "output" => $output]);

?>

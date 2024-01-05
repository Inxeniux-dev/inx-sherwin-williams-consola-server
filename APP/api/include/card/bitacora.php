<?php

  $card = isset($_GET["id"]) ? $_GET["id"] : 0;
  $tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : 0;
  $rows = isset($_GET["rows"]) ? $_GET["rows"] : 50;
  $suc = isset($_GET["suc"]) ? $_GET["suc"] : 0;


  $model->id = $card;
  $model->tipo = $tipo;
  $model->rows = $rows;
  $model->idsucursal = $suc;
  $cards = $model->getBitacora();

  $output = '<table class = "table table-sm table-condensed table-hover">
                <thead>
                    <th style = "width:25px;"></th>
                    <th>Concepto</th>
                    <th>Tipo de Canje</th>
                    <th>Sucursal</th>
                    <th style = "text-align:right">Puntos</th>
                    <th style = "text-align:right">Total</th>
                    <th style = "text-align:right">Fecha Servidor</th>
                    <th style = "text-align:right">Fecha Corte</th>
                    <th></th>
                </thead>
                <tbody>';

        while($row = $cards->fetch_object())
        {
            $concepto = $row->idconcepto == 1 ? 'Acumulado <b>Remisión '.$row->remision.'</b>' : 'Canje REF <b>'.$row->referencia.'</b>';
            $concepto = $row->idconcepto == 3 ? 'Expiración de puntos por inactividad' : $concepto;

            if($row->idconcepto == 1 && strlen($row->referencia))
            {
              $concepto.= " ".$row->referencia;
            }

            $movimiento = '';
            if($row->remision > 0)
            {
              $movimiento =  $row->idconcepto == 1 ? 'Acumulado por Venta' : '<b>Pintura</b>';
              $movimiento =  $row->idconcepto == 3 ? 'Expiración de Puntos' : $movimiento;
            }
            else if($row->remision == "ST")
            {
              $movimiento = 'Complementos';
            }
            else if($row->remision == 0) {
              $movimiento = $row->idconcepto == 3 ? "Expiración" : "Productos Diversos";
            }

            $icon = $row->idconcepto == 1 ? '<i class="fas fa-arrow-circle-up text-success"></i>' : '<i class="fas fa-arrow-circle-down text-danger"></i>';

            $output .= '<tr>
                            <td style = "width:25px;">'.$icon.'</td>
                            <td>'.$concepto.'</td>
                            <td>'.$movimiento.'</td>
                            <td>'.$row->nombre.'</td>
                            <td align = "right"><b>'.number_format($row->puntos, 0).'</b></td>
                            <td align = "right"><b>$'.number_format($row->total, 2).'</b></td>
                            <td align = "right"><i class="far fa-clock"></i> '.$row->create_at.'</td>
                            <td align = "right"><i class="far fa-clock"></i> '.$row->fecha_sucursal.'</td>
                            <td  align = "center">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <h6 class="dropdown-header"><b>Opciones</b></h6>
                                      <a class="dropdown-item" href="javascript:void(0);" ><i class="far fa-eye"></i> Ver Detalles</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="javascript:void(0);" ><i class="fas fa-receipt"></i> Genera Comprobante</a>';
                                      if($permisos->Editar)
                                      {
                                          $output .= '  <div class="dropdown-divider"></div>
                                                <h6 class="dropdown-header"><b>Opciones Avanzadas</b></h6>
                                                <a class="dropdown-item" href="javascript:void(0);" ><i class="fas fa-edit"></i> Editar Movimiento</a>';
                                      }
                              $output .= '</div>
                                </div>
                            </td>
                        <tr>';
        }


  $output.="</tbody>";

  echo json_encode(["code" => 200, "output" => $output])

?>

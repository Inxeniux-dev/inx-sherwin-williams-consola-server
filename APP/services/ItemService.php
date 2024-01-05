<?php

class ItemService
{

    public function ItemsTableList($data, $paginator)
    {
        $SISTEMA_CON_KARDEX = $_SESSION["config"]["use_kardex"];

        $output = "<table class='table table-hover table-condensed table-sm'>
                <thead>
                    <tr>
                        <th>Código</th>";
        if($SISTEMA_CON_KARDEX)
        {
            $output .= "<th style='text-align: right;'>Existencia</th>";
        }

            $output .= "<th style='text-align: right; cursor: pointer;' title = 'Descuento'>%</th>
                        <th style='text-align: right;'>Precio</th>
                        <th>&nbsp; Línea</th>
                        <th>Clave SAT</th>
                        <th align='center'><i class='fa fa-search'></th>
                    </tr>
                </thead>
                <tbody>
            <tbody>";

            while($rows = $data->fetch_object())
            {
                $cssclass = $rows->existencia == 0 ? 'text-danger' : 'text-primary';
                $iconstatus = $rows->existencia == 0 ? '<i class="fa fa-exclamation-triangle" title="Código sin existencias" style="cursor:pointer;"></i>' : '';
                $output.='<tr>
                            <td><b>'.$rows->codigo.'</b><br> '.str_replace("¥", "Ñ", strtoupper($rows->descripcion)).'</td>';

                if($SISTEMA_CON_KARDEX)
                {
                        $existencia = $rows->existencia > 0 ? "<b>".$rows->existencia."</b>" : $rows->existencia;
                        $output .= '<td align = "right">'.$existencia.'</td>';
                }
                        $output .= '<td align = "right">'.$rows->descuento.'</td>
                                    <td align = "right" class="text-success">$ '.number_format($rows->precio,2).'</td>
                                    <td> &nbsp;&nbsp; '.$rows->desclinea.'</td>
                                    <td> &nbsp;&nbsp; '.$rows->clave_sat.'</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="details/'.$rows->codigo.'/" ><i class="fa fa-search"></i> Ver Detalles</a>

                                                  <a class="dropdown-item" href="details/'.$rows->codigo.'/" ><i class="far fa-edit"></i> Editar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
            }

            $output.="</tbody></table><div class='box-footer'>";
            $output .= $paginator;
            $output.="</div>";
        return $output;
    }


    public function ItemKardexTableList($data, $paginator)
    {
        $SISTEMA_CON_KARDEX = $_SESSION["config"]["use_kardex"];

        $output = "<table class='table table-hover table-condensed table-sm'>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Serie-Doc</th>";
                if($SISTEMA_CON_KARDEX)
                {
                    $output .= "<th>Capa</th>";
                }
        $output .= "<th>Movimiento</th>
                    <th>Cantidad</th>";

        if($SISTEMA_CON_KARDEX)
        {
             $output .= "<th>Cantidad actual</th>";
        }

        $output .="<th>Precio</th>
                    <th align='center'><i class='fa fa-search'></th>
                </tr>
            </thead>
            <tbody>
        <tbody>";

        while($rows = $data->fetch_object())
                {
                    $color_label = "success";
                    if($rows->tipo == 0){ $color_label = "danger";}

                $cssrow = $rows->cantidad <= 0 ? "class = 'table-danger'" : "";
                $existencia = $rows->existencia;

                if($rows->no_aplicado == 1)
                {
                  $cssrow = "class = 'table-info'";
                  $existencia = "PRODUCTO NO APLICADO";
                }
                if($rows->no_aplicado == 2)
                { $cssrow = "class = 'table-info'";
                  $existencia = "PRODUCTO APLICADO";
                }

                $output.='<tr '.$cssrow.'>
                            <td class="text-primary">'.$rows->fecha.'</td>
                            <td>'.$rows->folio.'</td>';

                            if($SISTEMA_CON_KARDEX)
                            {
                                $output.=' <td>'.$rows->capa.'</td>';
                            }

                 $output.=' <td class="text-'.$color_label.'"><b>'. str_replace("¥", "Ñ", strtoupper($rows->descripcion)).'</b></td>
                            <td class="text-'.$color_label.'">'.$rows->cantidad.'</td>';

                      if($SISTEMA_CON_KARDEX)
                      {
                        $output.='<td>'.$existencia.'</td>';
                      }

                       $output.= '<td>$ '.number_format($rows->precio,2).'</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0);" ><i class="fa fa-search"></i> Ver documento</a>
                                    </div>
                                </div>
                            </td>';
                }
        $output .= "</tbody></table><div class='box-footer'>";
        $output .= $paginator;
        $output .= "</div>";
        return $output;
     }

}

?>

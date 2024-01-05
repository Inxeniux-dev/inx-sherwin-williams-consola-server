<?php

    $catalogModel = new CatalogModel();
    $data = $catalogModel->getCFDIUse();

    $output = '';
    if($data)
    {
        $output .= '<table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Uso</th>
                            </tr>
                        </thead>
                        <tbody>';

                        while($row = $data->fetch_object())
                        {
                            
                                $output .= '<tr class = "hand" onclick = "change_CFDI('.$row->idusocfdi.');">
                                                <td>'.$row->clave.'</td>
                                                <td>'.$row->descripcion.'</td>
                                            </tr>';
                        }

        $output .= '</tbody></table>';
                        
        echo json_encode(["code" => 201, "html" => $output]);
        return;
    }

    echo json_encode(["code" => 200, "html" => ""]);
?>
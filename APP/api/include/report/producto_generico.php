<?php


  $location = isset($_GET["location"]) ? $_GET["location"] : $_GET["location"];
  $date = isset($_GET["date"]) ? $_GET["date"] : $_GET["date"];

  $url = $_SESSION["config"]["api_url"]."/item/generic_prod.php?&&key=".API_KEY."&&location=".$location."&&date=".$date;

  $data = null;
    $options = stream_context_create(array('http'=>
      array(
      'timeout' => 180
      )
  ));

  $status_conection = false;
  if(@file_get_contents($url, false, $options)){
      $json = file_get_contents($url);
      $status_conection = true;
          if($json != null )
          {
              $data = json_decode($json, true);
          }
   }

$output = '';
if($data)
{
  $_SESSION["PROD_GENERIC"] = $data;

      $output .= '<table class = "table table-sm table-hover">

                    <thead>
                      <tr>
                          <th>Sucursal</th>
                          <th>Fecha</th>
                          <th style = "text-align:right;">Saldo Final Prod. Gen.</th>
                          <th style = "text-align:right;">% Sobre Inv. Total</th>
                          <th style = "text-align:right;">Total Producto SM</th>
                          <th style = "text-align:right;">% Según Muestra</th>
                      </tr>
                    </thead>
                    <tbody>';

                    $data = to_object($data);

                    $sucursales = $data->data;

                    foreach ($sucursales as $key => $value) {
                        $datos = $value->data;
                        $output .= '<tr>
                                      <td>'.$value->sucursal.'</td>
                                      <td>'.$datos->date.'</td>
                                      <td align = "right">'.number_format($datos->existencia,0).'</td>
                                      <td align = "right">'.number_format($datos->promedio,4).'%</td>
                                      <td align = "right">'.number_format($datos->total_codes,0).'</td>
                                      <td align = "right">'.number_format($datos->promedio_codes,4).'%</td>
                                  </tr>';
                    }

              $output .= '</tbody>
          </table>';
}
else {
  if(isset($_SESSION['PROD_GENERIC']))
  {
    unset($_SESSION['PROD_GENERIC']);
  }
}

echo json_encode(["code" => 200, "data" => $output]);
return;
?>

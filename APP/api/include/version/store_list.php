<?php

$store_model = new StoreModel();
$stores = $store_model->getList();
$version = $model->getLastVersionProductionByProyect(1);

$version_match = 'N/A';
while($row = $version->fetch_object())
{
  $version_match = $row->version;
}

$DATA_VERSION = [];

$output = '';

$table = '<table class = "table table-hover table-stores">
              <thead>
                  <th style = "text-align:center">Clave</th>
                  <th style = "text-align:lefth">Sucursal</th>
                  <th style = "text-align:right">IP Remota</th>
                  <th style = "text-align:right">Versión Sistema</th>
                  <th  style = "text-align:right">Versión en BD</th>
                  <th></th>
              </thead>
              <tbody>';

				$count_connect = 0;
				$count_ok = 0;
				$count_err = 0;
              while($row = $stores->fetch_object())
              {
                  if($row->version == 1 && $row->status == 1)
                  {

                      $URL = "http://".$row->ip."/pventa/app/api/version.php";
                      $curl = curl_init();
    									curl_setopt_array($curl, array(
    									  CURLOPT_URL => $URL,
    									  CURLOPT_RETURNTRANSFER => true,
    									  CURLOPT_ENCODING => '',
    									  CURLOPT_MAXREDIRS => 3,
    									  CURLOPT_TIMEOUT => 3,
    									  CURLOPT_FOLLOWLOCATION => true,
    									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    									  CURLOPT_CUSTOMREQUEST => 'GET'
    									));

    									$response = curl_exec($curl);
    									curl_close($curl);

                      $str = str_replace("\xEF\xBB\xBF",'',$response);
                      $response = json_decode($str);

    									$icon = "<i class='fas fa-exclamation-triangle text-warning' title = 'Sin Conexión'></i>";

    									$version = 'Sin conexión';
    									$version_db = 'Sin conexión';
    									$clave_suc = $row->idsucursal;
                      $str_detalle = '';
                      if($response)
    									{
      										$data = $response;
      										$version = $data->version;
      										$version_db = $data->version_en_db;
      										$clave_suc = $data->clave_suc;

                          $str_detalle = 'Versión Correcta';
      										$icon = "<i class='fas fa-check-circle text-success' title = 'Versión Correcta'></i>";

      										if(trim($data->version) != $version_match || trim($data->version_en_db) != $version_match)
      										{
      											$icon = '<i class="fas fa-exclamation-circle text-danger" title = "Versión No Actualizada"></i>';
                            $str_detalle = 'Versión No Actualizada';
    											$count_err++;
      										}
    										else
    										{
    											$count_ok++;
    										}
    									}
    									else{
    										$count_connect++;
    									}

                        $table.= '<tr>
                                        <td align = "center"><b>'.addCeros($clave_suc).'</b></td>
                                        <td align = "lefth">'.$row->nombre.'</td>
                                        <td align = "right">'.$row->ip.'</td>
                                        <td align = "right"><b>'.$version.'</b></td>
                                        <td align = "right"><b>'.$version_db.'</b></td>
                                        <td align = "center" style = "font-size:15px;">'.$icon.'</td>
                                   </tr>';
                  
                            $DATA_VERSION[] = ["clave" => addCeros($clave_suc), "nombre" => $row->nombre, "ip" => $row->ip, "version" => $version, "version_db" =>  $version_db, "observacion" => $str_detalle];
                  }
              }

			  $head = '<b><i class="fas fa-exclamation-triangle text-warning"></i> Sin conexión:</b> '.number_format($count_connect,0)."<br>";
			  $head .= '<b><i class="fas fa-exclamation-circle text-danger"></i> Sin actualizar:</b> '.number_format($count_err,0)."<br>";
			  $head .= '<b><i class="fas fa-check-circle text-success"></i> Actualizadas:</b> '.number_format($count_ok,0)."<br><br>";

$table.= "</tbody></table>";

$output .= $head.$table;

$_SESSION['DATA_VERSION'] = $DATA_VERSION;

echo json_encode(["code" => 200, "output" => $output]);


?>

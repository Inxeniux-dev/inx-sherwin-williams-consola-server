<?php


if(MODE == "SERVER")
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["No se puede sincronizar, cuando estás en modo SERVIDOR"], "msg" => "Sincronización Fallida UUID"]);
  return;
}

$xmlService = new XMLService();

$hoy = $_SESSION["config"]["date_corte"];
$fecha_semanal = SumarORestarFechas($hoy, "-", WEEK_SYNC_UUID, "week");

$data = $model->getListByUUID($fecha_semanal, $hoy);

$folios = array();
if($data)
{
  while($row = $data->fetch_object())
  {
      $folios[] = $row->serie_factura."-".$row->folio_factura;
  }
}

$data = $xmlService->getUUIDBySales($folios);

if($data)
{
  if(count($data) > 0)
  {
        foreach ($data["uuids"] as $key => $value) {
            $value = to_object($value);
            $aux = explode("-", $value->folio);
            $model->updateUUID($aux[1], $aux[0], $value->uuid);
        }
  }
}

echo json_encode(["code" => 201, "status" => true, "error" => [], "msg" => "Sincronización Finalizada UUID"]);
return;
?>

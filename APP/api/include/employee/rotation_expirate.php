<?php

$idrotacion = isset($_POST["idrotacion"]) ? $_POST["idrotacion"] : 0;

$modelRotacion->id = $idrotacion;
$modelRotacion->expiracion = SumarORestarFechas(date("Y-m-d"), "-", "1", "day");
if($modelRotacion->update())
{
    echo json_encode(["code" => 201, "msg" => "Update"]); return;
}

echo json_encode(["code" => 200,  "error" => ["El registro no se ha modificado"]]); return;
?>

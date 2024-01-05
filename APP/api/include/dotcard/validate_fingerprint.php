<?php

if($_SESSION["config"]["bloqueo"] == 1) { echo json_encode(["code" => 200, "status" => false, "error" => ["Ya se ha generado el reporte del cierre del día"]]); return; }

if(!$_SESSION["config"]["unlok_system"])
{
    if(date("Y-m-d") != $_SESSION["config"]["date_corte"]) { echo json_encode(["code" => 200, "status" => false, "error" => ["La fecha del corte no coincide con la fecha del sistema"]]); return;  }
}


$data = [
    "token" => isset($_POST["token"]) ? $_POST["token"] : null,
    "identified" => isset($_POST["identified"]) ? $_POST["identified"] : 0
];

if(strlen($data["token"]) < 10 || !is_numeric($data["token"]))
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["El token es incorrecto"]]); return;
}

if(strlen($data["identified"]) <= 0 || !is_numeric($data["identified"]))
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["El identificador de la tarjeta es incorrecto"]]); return;
}

$data = $model->chekStatusHuella($data);

if(!$data)
{
   echo json_encode(["code" => 200, "status" => false, "error" => ["El pintor no ha sido identificado"]]); return;
}

if($data)
{
  $status = false;
  while($row = $data->fetch_object())
  {
    $status = $row->status;
  }

    if($status == 1)
    {
      echo json_encode(["code" => 200, "status" => true, "msg" => "Pintor identificado correctamente", "error" => []]); return;
    }
}

  echo json_encode(["code" => 200, "status" => false, "error" => ["El pintor no se ha identificado"]]); return;
?>

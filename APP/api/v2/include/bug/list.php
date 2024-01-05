<?php
$comentario = isset($_GET["comentario"]) ? $_GET["comentario"] : '';
$idsucursal = isset($_GET["idsucursal"]) ? $_GET["idsucursal"] : '';
$detail = isset($_GET["detail"]) ? $_GET["detail"] : false;

$bug = new Incidencia();
$bug->search = $comentario;
$data = $bug->all();

if($data)
{
  $incidencias = [];
  $paginator = [];

  while($row = $data["incidencias"]->fetch_object())
  {
    $incidencias[] = $row;
  }

  while($row = $data["paginator"]->fetch_object())
  {
    $paginator[] = $row;
  }

  echo json_encode(["code"=> 201, "incidencias" => $incidencias, "paginator" => $paginator]); return;
}
echo json_encode(["code"=> 200]); return;
?>

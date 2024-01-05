<?php

$lastIdPrices = isset($_GET["lastIdPrices"]) ? $_GET["lastIdPrices"] : 0;

$sql = "SELECT * FROM linea;";
$response = $conexion->query($sql);

$lineas = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $lineas[] = $row;
  }
}


$sql = "SELECT * FROM capacidad;";
$response = $conexion->query($sql);

$capacidades = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $capacidades[] = $row;
  }
}


$sql = "SELECT * FROM clave_sat;";
$response = $conexion->query($sql);

$clave_sat = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $clave_sat[] = $row;
  }
}


$sql = "SELECT * FROM marca;";
$response = $conexion->query($sql);

$marcas = array();
if($response)
{
  while($row = $response->fetch_object())
  {
    $marcas[] = $row;
  }
}



$fullprices = [];
if($lastIdPrices >= 0){

  $sql = "SELECT id, created_at, no_prod, `user`.nombre FROM cambio_precio INNER JOIN user ON cambio_precio.user_id = `user`.iduser WHERE id > '".$lastIdPrices."' ORDER BY id ASC;";
  $response = $conexion->query($sql); 
  if($response)
  {
      while($row = $response->fetch_object())
      {
            $sql = "SELECT precio_anterior, precio_nuevo AS precio, data FROM cambio_precio_detalle WHERE cambio_precio_id = '".$row->id."';";
            $response_prod = $conexion->query($sql);
            $detail = [];
            if($response_prod)
            {
              while($rowp = $response_prod->fetch_object())
              {
                if($rowp->data != null)
                    $detail[] = json_decode($rowp->data);
                }
            }
            
              if(count($detail) > 0)
              {
                $fullprices[] = [
                  "id" => $row->id,
                  "created_at" => $row->created_at,
                  "no_prod" => $row->no_prod,
                  "nombre" => $row->nombre,
                  "detail" => $detail
                ];
            }
      }
  }
}





$data = [
    "lineas" => $lineas,
    "capacidades" => $capacidades,
    "clave_sat" => $clave_sat,
    "marcas" => $marcas,
    "prices" => $fullprices
  ];


echo json_encode($data);
return;

 ?>

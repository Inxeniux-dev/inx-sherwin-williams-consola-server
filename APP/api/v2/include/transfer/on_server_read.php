<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;

$name = isset($_GET["name"]) ? $_GET["name"] : null;

if($name != null)
{

  $dir = $PATH_TRANSFER.$name;

  if(file_exists($dir)){

    $xml=simplexml_load_file($dir);
    $comentario = (!isset($xml->data->coment) || $xml->data->coment == null) ? "" : strval($xml->data->coment);

     $idchofer=$xml->data->id_chofer;
     $total_productos=count($xml->productos->product);
     $fecha = '';

    for($x=0; $x<$total_productos; $x++){
          $fecha = strval($xml->productos->product[$x]->FECHA);
          
          $datos[] = array(
             "codigo" => strval($xml->productos->product[$x]->CODIGO),
             "capa" => strval($xml->productos->product[$x]->CAPA),
             "fecha" => strval($xml->productos->product[$x]->FECHA),
             "folio" => strval($xml->productos->product[$x]->FOL),
             "serie_vale" => strval($xml->productos->product[$x]->SV),
             "folio_vale" => strval($xml->productos->product[$x]->VALE),
             "movimiento" => strval($xml->productos->product[$x]->MOV),
             "cantidad" => strval($xml->productos->product[$x]->CANT),
             "flete" => strval($xml->productos->product[$x]->FLETE),
             "costo" => strval($xml->productos->product[$x]->COSTO),
             "precio" => strval($xml->productos->product[$x]->PRECIO),
           );
     }

     $comentario  = str_replace("'", "", $comentario);
     $comentario  = str_replace("\"", "", $comentario);
     $comentario  = str_replace("ñ", "n", $comentario);
     $comentario  = str_replace("Ñ", "N", $comentario);
     $comentario  = str_replace('"', '"', $comentario);

     $fecha = (strlen($fecha) > 8) ? substr($fecha,0, 10) : $fecha;

     $head = array(
         "idchofer" => abs($idchofer),
         "fecha" => $fecha,
         "comentario" => $comentario,
     );

     $response = array("code" => 201, "data" => $head, "product" => $datos);
     echo json_encode($response);
     return;
  }
  else{
     $response = array("code" => 200, "data" => null, "product" => null);
     echo json_encode($response);
     return;
  }
}


 ?>

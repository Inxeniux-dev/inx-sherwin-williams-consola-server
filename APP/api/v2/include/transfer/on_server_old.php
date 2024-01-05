<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;


$location = isset($_GET["location"]) ? $_GET["location"] : 0;
$corte = isset($_GET["corte"]) ? $_GET["corte"] : date("Y-m-d");
$days = isset($_GET["days"]) ? $_GET["days"] : 0;
$vencimiento = SumarORestarFechas($corte, "+", $days, "day");

date_default_timezone_set("America/Mexico_City");


if($location == 0 || $corte == 0 || $days == 0)
{
    echo json_encode(["code" => 200, "message" => "Parametros incorrectos"]);
    return;
}

$dir = $PATH_TRANSFER;

    if (is_dir($dir)){
      if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){

            $name = strtolower($file);
            $pos = strpos($name, "xml");
            if ($pos === false) {} else {

                 $suc_env = (substr($name, 0, 2));
                 $suc_rec = (substr($name, 2, 2));
                 $fol_val = substr($name, 4);

          				if($location == $suc_rec)
          				{

                     $xml=@simplexml_load_file($dir."\\".$name);
                     $folio_xml = abs($xml->data->folio);
                     $fecha = strval($xml->data->date_file);
                     $serie = strval($xml->data->serie);
                     $idchofer=$xml->data->id_chofer;

                     $diferencia = days_diference(substr($fecha,0, 10), $corte);
                     $comentario = "";

          					if(!isset($xml->data->coment) || $xml->data->coment == null)
          					{
          						$comentario = "";
          					}
          					else
          					{
          						$comentario = sanear_string(strval($xml->data->coment));
          					}

                               $comentario  = str_replace("'", "", $comentario);
                               $comentario  = str_replace("\"", "", $comentario);
                               $comentario  = str_replace("ñ", "n", $comentario);
                               $comentario  = str_replace("Ñ", "N", $comentario);


                                 if($diferencia >= $days)
                                 {
                                       $items = array();
                                       $total_productos=count($xml->productos->product);
                                       for($x=0; $x<$total_productos; $x++){
                                              $items[] = array(
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


                                      $datos[] = array(
                                        "idchofer" => abs($idchofer),
                                        "name" => $file,
                                        "folio" => $folio_xml,
                                        "receptor" => $suc_rec,
                                        "emisor" => $suc_env,
                                        "serie" => $serie,
                                        "fecha" => $fecha,
                                        "dif" => $diferencia,
                                        "comentario" => $comentario,
                                        "items" => $items
                                      );
                                 }
          				      }
           }
        }
        closedir($dh);
      }
    }

echo json_encode(array("code" => 201, "data" => $datos));
return;

?>

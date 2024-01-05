<?php
  if(!$permisos->Editar_Precio && !$permisos->Editar_Descuento){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$data = $model->list(-1, 0, 0, null);

$modelConfig = new SettingModel();
$config = $modelConfig->one();
$PATH_PRICES = $config->path_prices;
$PATH_PRICES = strlen($PATH_PRICES) == 0 ? "C:/" : $PATH_PRICES;


$lineModel = new LineModel();
$lineas = $lineModel->all();
$lines = [];
if($lineas){
    
    while($row = $lineas["linea"]->fetch_object())
    {
        $lines[] = [
            "id" => $row->idlinea, 
            "nombre" => $row->descripcion,
            "tipo" => $row->tipo,
            "para_igualado" => $row->para_igualado,
            "para_conversion" => $row->para_conversion
        ];
    }
  
}


if($data)
{
    $head = array("date" => date("Y-m-d"));

    while ($row = $data->fetch_object()) {
      $productos[] = array(
                    "codigo" => $row->codigo,
                    "barcode" => $row->barcode,
                    "linea" => $row->idlinea,
                    "descrip" => str_replace(";", " ", $row->descripcion),
                    "costo" => 0,
                    "precio" => $row->precio,
                    "descuento"=> strlen($row->descuento) == 0 ? 0 : $row->descuento,
                    "fechini" => strlen($row->fechini) == 0 ? date("Y-m-d") : $row->fechini,
                    "fechfin" => strlen($row->fechfin) == 0 ? date("Y-m-d") : $row->fechfin,
                    "clavesat" => $row->clave_sat,
                    "capacidad" => $row->idcapacidad,
                    "es_base" => $row->es_base,
                    "peso" => $row->peso,
                    "precio_especial" => round($row->precio_especial),
                    "codigo_asociado" => $row->codigo_asociado,
                    "idmarca" => $row->idmarca
                );
    }
}

$prods = $productos;

try {

  	$xml=new DomDocument('1.0');
    $xml->formatOutput=true;

    $conten=$xml->createElement("contend");
    $xml->appendChild($conten);

    $data=$xml->createElement("data");
    $conten->appendChild($data);

    $name=$xml->createElement("name","XML_PRECIOS_PDV");
    $data->appendChild($name);

    $datefile=$xml->createElement("date_file", date("Y-m-d"));
    $data->appendChild($datefile);

    $datefile=$xml->createElement("name_file","CAMBPRE".date("YmdHis"));
    $data->appendChild($datefile);

	  $datefile=$xml->createElement("generate", "COMEX_SERVER");
    $data->appendChild($datefile);

    $productos=$xml->createElement("productos");
    $conten->appendChild($productos);


			foreach ($prods as $key => $value) {

          $value = to_object($value);

					$prod=$xml->createElement("product");
					$prod->setAttribute("id", $key);
					$productos->appendChild($prod);


					$codebar="0";
					if(trim($value->barcode) != "" )
					{
						$codebar= $value->barcode;
					}


					$DESCRIPCION = eliminarDobleEspacios(str_replace(";", " ", $value->descrip));

					$linea=$xml->createElement("linea", $value->linea);
					$prod->appendChild($linea);

					$code=$xml->createElement("code", $value->codigo);
					$prod->appendChild($code);

					$codbar=$xml->createElement("codbar",$codebar);
					$prod->appendChild($codbar);

					$descrip=$xml->createElement("descrip",htmlspecialchars($DESCRIPCION));
					$prod->appendChild($descrip);

					$costo=$xml->createElement("costo", $value->precio);
					$prod->appendChild($costo);

					$prec_vent=$xml->createElement("prec_vent", $value->precio);
					$prod->appendChild($prec_vent);

					$prec_esp=$xml->createElement("prec_esp", $value->precio_especial);
					$prod->appendChild($prec_esp);

					$descont=$xml->createElement("descont", $value->descuento);
					$prod->appendChild($descont);

					$descont=$xml->createElement("fechini", $value->fechini);
					$prod->appendChild($descont);

					$descont=$xml->createElement("fechfin",$value->fechfin);
					$prod->appendChild($descont);

					$descont=$xml->createElement("clavesat", $value->clavesat);
					$prod->appendChild($descont);

					$idcapacidad=$xml->createElement("idcapacidad", $value->capacidad);
					$prod->appendChild($idcapacidad);

					$es_base=$xml->createElement("es_base", $value->es_base);
					$prod->appendChild($es_base);

					$peso=$xml->createElement("peso", $value->peso);
					$prod->appendChild($peso);

          $codigo_asociado=$xml->createElement("codigo_asociado", $value->codigo_asociado);
					$prod->appendChild($codigo_asociado);

          $idmarca=$xml->createElement("idmarca", $value->idmarca);
          $prod->appendChild($idmarca);

			}


      $lineas=$xml->createElement("lineas");
      $conten->appendChild($lineas);

      foreach ($lines as $key => $value) {
        $value = to_object($value);

        $line=$xml->createElement("line");
        $line->setAttribute("i", $key);
        $lineas->appendChild($line);

        $id=$xml->createElement("id", $value->id);
				$line->appendChild($id);

        $nombre=$xml->createElement("nombre", $value->nombre);
				$line->appendChild($nombre);

        $tipo=$xml->createElement("tipo", $value->tipo);
				$line->appendChild($tipo);

        $para_igualado=$xml->createElement("para_igualado", $value->para_igualado);
				$line->appendChild($para_igualado);

        $para_conversion=$xml->createElement("para_conversion", $value->para_conversion);
				$line->appendChild($para_conversion);


      }



			if($xml->save($PATH_PRICES."MSTINVEN.xml")){
				    $response = true;
			}
			else
			{
			     $response = false;
			}

      $code = $response ? 201 : 200;
      $error = $response ? [] : ["Error al generar el archivo de precios"];
      echo json_encode(["code" => $code, "error" => $error]);
      return;
		}
		catch(Exception $e){
        $response = false;
        $code = $response ? 201 : 200;
        $error = $response ? [] : ["Error al generar el archivo de precios"];
        echo json_encode(["code" => $code, "error" => $error]);
        return;
		}

?>
